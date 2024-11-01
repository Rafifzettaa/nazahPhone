<?php
session_start();
include 'koneksi.php';
$user_id = $_SESSION['id_user'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT 
    customer.nama,
    customer.phone,
    customer.jenis_kelamin,
    customer.tanggal_lahir,
    alamat.detail_alamat,
    alamat.kota,
    alamat.kode_pos,
    alamat.provinsi,
    user.email
FROM customer
JOIN user ON customer.id_user = user.id_user
JOIN alamat ON customer.id_alamat = alamat.id_alamat
WHERE customer.id_user = $user_id";
    $query = mysqli_query($db, $sql);
    $n = mysqli_fetch_assoc($query);
    // Ambil informasi dari formulir checkout
    $alamat_pengiriman = $_POST['address'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Dapatkan informasi keranjang belanja dari session
    $user_id = $_SESSION['id_user'];
    $total_harga = 0;
    $keranjang_query = mysqli_query($db, "SELECT * FROM keranjang WHERE id_user = '$user_id'");
    $cart_items = array();

    while ($row = mysqli_fetch_assoc($keranjang_query)) {
        $cart_items[] = $row;

        $total_harga += $row['harga_produk'] * $row['jumlah_produk'];
    }


    // Buat nomor pesanan unik
    $order_id = uniqid('NAZAH-');

    // Simpan informasi pesanan ke database
    $insert_order_sql = "INSERT INTO transaksi (order_id, id_user, alamat_pengiriman, metode_pembayaran,tanggal_pesan,  status_pembayaran, status, total_harga)
    VALUES ('$order_id', '$user_id', '" . $n['detail_alamat'] . "', 'gopay',NOW(), 'menunggu',  'menunggu', '$total_harga')";
    mysqli_query($db, $insert_order_sql);

    if ($insert_order_sql) {

        $id_order = mysqli_insert_id($db);
        foreach ($cart_items as $row) {
            $id_produk = $row['id_produk'];
            $jumlah_produk = $row['jumlah_produk'];

            $harga = $row['harga_produk'];

            $insert_order_item_sql = "INSERT INTO pemesanan (id_order,id_produk,harga_produk,jumlah_produk) VALUES ('$id_order', '$id_produk','$harga' ,'$jumlah_produk')";
            $result = mysqli_query($db, $insert_order_item_sql);

            if (!$result) {
                // Cetak pesan kesalahan jika query gagal
                echo 'Error inserting order item: ' . mysqli_error($db);
            }

            // Update stok dan terjual
            $update_produk_sql = "UPDATE produk SET stok = stok - $jumlah_produk, terjual = terjual + $jumlah_produk WHERE id_produk = '$id_produk'";
            $update_produk_result = mysqli_query($db, $update_produk_sql);

            if (!$update_produk_result) {
                // Cetak pesan kesalahan jika query gagal
                echo 'Error updating product stock: ' . mysqli_error($db);
            }
        }


       
    }


    // Setelah selesai, Anda dapat mengarahkan pengguna ke halaman pembayaran Midtrans
    require_once 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Set Your server key
    Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
    $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

    // Enable sanitization
    Midtrans\Config::$isSanitized = true;

    // Enable 3D-Secure
    Midtrans\Config::$is3ds = true;

    $total_harga = intval($total_harga);
    // Ambil data barang dari keranjang
    $item_details = array();
    // Fetch details for the selected item from the database
    $item_query = mysqli_query($db, "SELECT * FROM keranjang WHERE id_user = '$user_id'");
    while ($item_row = mysqli_fetch_assoc($item_query)) {
        $total_harga = $item_row['jumlah_produk'] * $item_row['harga_produk'];
    
        // Add details to the $item_details array
        $item_details[] = array(
            'id'       => $item_row['id_produk'],
            'price'    => $item_row['harga_produk'],
            'quantity' => $item_row['jumlah_produk'],
            'name'     => $item_row['nama_produk']
        );
    }
    

    


    // Ambil data pelanggan dari input
    $billing_address = array(
        'first_name'    => $_POST['first_name'],
        // 'email'    => $_POST['email'],
        'address'       => $_POST['address'],
        'city'          => $_POST['city'],
        'postal_code'   => $_POST['postal_code'],
        'phone'         => $_POST['phone']

    );



    // Mendapatkan id_alamat_pembayaran yang baru saja dimasukkan
    $id_alamat_pembayaran = mysqli_insert_id($db);
   
    // Optional
    $customer_details = array(
        'first_name'    => $_POST['first_name'],
        // 'last_name'     => $_POST['last_name'],
        'email'         => $_POST['email'],
        'phone'         => $_POST['phone'],
        'billing_address'  => $billing_address,
        'shipping_address' => $billing_address  // Untuk sederhana, anggap alamat pengiriman sama dengan alamat tagihan
    );


    // Optional, remove this to display all available payment methods
    if ($_POST['metode_pembayaran'] == "credit_card") {
        $enable_payments = array('credit_card');
    } else if ($_POST['metode_pembayaran'] == "shopeepay") {
        $enable_payments = array('shopeepay');
    } else if ($_POST['metode_pembayaran'] == "pembayaran") {
        // $enable_payments = array('shopee');
    } else if ($_POST['metode_pembayaran'] == "echannel") {
        $enable_payments = array('echannel');
    } else if ($_POST['metode_pembayaran'] == "gopay") {
        $enable_payments = array('gopay');
    } else {
        echo "TIDAK DIKETAHUI";
    }

    // $enable_payments = array('credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel');


    // Fill transaction details
    $transaction_details = array(
        'order_id' => $order_id,
        'gross_amount' => $total_harga, // Sesuaikan dengan total harga pesanan
    );
   


    // Fill transaction details
    $transaction = array(
        'enabled_payments' => $enable_payments,
        'transaction_details' => $transaction_details,
        'customer_details' => $customer_details,
        'item_details' => $item_details,
    );

    $snapToken = Midtrans\Snap::getSnapToken($transaction);
    // echo $snapToken;


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Integrasi midtrans di aplikasi payment sederhana - qadrlabs.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>



    <div class="container mt-3">
        <h2>Checkout Process</h2>
        <div class="row mt-1">
            <div class="col col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Detail Customer:</h3>
                        <?php
                        // Menampilkan detail data customer
                        echo "<p><strong>First Name:</strong> " . $_POST['first_name'] . "</p>";
                        echo "<p><strong>Email:</strong> " . $_POST['email'] . "</p>";
                        echo "<p><strong>Phone:</strong> " . $_POST['phone'] . "</p>";
                        echo "<p><strong>Address:</strong> " . $_POST['address'] . "</p>";
                        echo "<p><strong>City:</strong> " . $_POST['city'] . "</p>";
                        echo "<p><strong>Postal Code:</strong> " . $_POST['postal_code'] . "</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Detail Harga Produk dan Produk:</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID Produk</ths>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga Produk</th>
                                    <th scope="col">Jumlah Produk</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Menampilkan detail harga produk dan produk
                                $no = 0;
                                $total_harga = 0;
                                $keranjang_query = mysqli_query($db, "SELECT keranjang.*, produk.gambar_a FROM keranjang JOIN produk ON keranjang.id_produk = produk.id_produk WHERE keranjang.id_user = '$user_id'");                                while ($row = mysqli_fetch_assoc($keranjang_query)) {
                                    $total_harga += $row['harga_produk'] * $row['jumlah_produk'];
                                ?>
                                    <tr>
                                        <td><?php echo $row['id_produk'] ?> </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="admin/image/<?php echo $row['gambar_a'] ?>" alt="Product Image" class="img-thumbnail me-2" style="width: 120px; height: 120px;">
                                                <div>
                                                    <div><?php echo $row['nama_produk'] ?></div>
                                                    <small class="text-muted">Variasi</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp.<?php echo number_format($row['harga_produk']) ?></td>
                                        <td> <?php echo  $row['jumlah_produk'] ?> </td>
                                        <td>Rp.<?php echo  number_format($row['harga_produk'] * $row['jumlah_produk']) ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span>Total (<?php echo $no - 1; ?> Produk): Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                        <button class="btn btn-success text-lg-center" id="pay-button">Bayar!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-sm">
        <a class="btn btn-outline-secondary" href="keranjang.php">Kembali ke Keranjang</a>
    </div>


    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            var selectedItems = [];
            var checkboxes = document.getElementsByName('selected_items[]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selectedItems.push(checkboxes[i].value);
                }
            }
            // Kirim permintaan AJAX ke server untuk mendapatkan detail barang
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'get_item_details.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var itemDetails = JSON.parse(xhr.responseText);

                    // Gunakan itemDetails untuk menentukan harga dan detail barang dalam transaksi
                    snap.pay('<?php echo $snapToken ?>', {
                        // ...
                        item_details: itemDetails,
                        // ...
                    });
                }
            };

            // Kirim data selectedItems ke server
            var data = 'selected_items=' + JSON.stringify(selectedItems);
            xhr.send(data);
            console.log(selectedItems);

            // SnapToken acquired from previous step
            snap.pay('<?php echo $snapToken ?>'), {
                // Optional
                onSuccess: function(result) {
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    document.getElementById('result-json').innerHTML += '<div class="alert alert-danger" ><br>Pembayaran belum diproses. Silakan cek kembali nanti.</div>';
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
            };
        };
    </script>
    <?php
    
     // Pindahkan bagian penghapusan item keranjang ke sini
 $delete_cart_item_sql = "DELETE FROM keranjang WHERE  id_user = '$user_id'";
 $_SESSION['cart_count'] -= $jumlah_produk;
 $deletequery = mysqli_query($db, $delete_cart_item_sql);

 if (!$deletequery) {
     echo 'Error deleting cart item: ' . mysqli_error($db);
 }

    ?>
</body>

</html>