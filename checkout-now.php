<?php
session_start();
include 'koneksi.php';
$user_id = $_SESSION['id_user'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT 
    customer.id_customer,
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

    $idproduk = $_POST['product_id'];

    $query = mysqli_query($db, $sql);
    $n = mysqli_fetch_assoc($query);

    $get_id_keranjang_sql = "SELECT id_keranjang FROM keranjang WHERE id_produk = '$idproduk' AND id_user = '$user_id'";
    $id_keranjang_result = mysqli_query($db, $get_id_keranjang_sql);
    $row = mysqli_fetch_assoc($id_keranjang_result);

    //mengambil nilai

    $namaproduk = $_POST['nama_produk'];
    $jumlah = $_POST['quantity'];
    $harga = $_POST['harga_produk'];
    $total_harga = 0;


    $total_harga += $harga * $jumlah;
    $total_harga = intval($total_harga);
    // Ambil informasi dari formulir checkout
    $alamat_pengiriman = $n['detail_alamat'];
    // $metode_pembayaran = $_POST['metode_pembayaran'];



    // Buat nomor pesanan unik
    $order_id = uniqid('NAZAH-');

    // Simpan informasi pesanan ke database
    $insert_order_sql = "INSERT INTO transaksi (order_id, id_user, alamat_pengiriman, metode_pembayaran,tanggal_pesan,  status_pembayaran, status, total_harga)
VALUES ('$order_id', '$user_id', '" . $n['detail_alamat'] . "', 'gopay',NOW(), 'menunggu',  'menunggu', '$total_harga')";
    mysqli_query($db, $insert_order_sql);




    $idtr = mysqli_insert_id($db);
    // Simpan informasi item pesanan ke database
    $insert_order_item_sql = "INSERT INTO pemesanan (id_order,id_produk,harga_produk,jumlah_produk) VALUES ('$idtr', '$idproduk','$harga' ,'$jumlah')";
    $result = mysqli_query($db, $insert_order_item_sql);

    if (!$result) {
        // Cetak pesan kesalahan jika query gagal
        echo 'Error: ' . mysqli_error($db);
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



$item_details[] = array(
    'id' => $idproduk,
    'price' => $harga,
    'quantity' => $jumlah,
    'name' => $namaproduk
);
// }
$user_id = $_SESSION['id_user'];

// Ambil data pelanggan dari input
$billing_address = array(
    'first_name'    => $n['nama'],
    // 'email'    => $_POST['email'],
    'address'       => $n['detail_alamat'],
    'city'          => $n['kota'],
    'postal_code'   => $n['kode_pos'],
    'phone'         => $n['phone']

);

// Gunakan nilai dari array asosiatif untuk memasukkan data ke database

// Optional
$customer_details = array(
    'first_name'    => $n['nama'],
    // 'last_name'     => $_POST['last_name'],
    'email'         => $n['email'],
    'phone'         => $n['phone'],
    'billing_address'  => $billing_address,
    'shipping_address' => $billing_address  // Untuk sederhana, anggap alamat pengiriman sama dengan alamat tagihan
);
$QuerycheckCustomer = "SELECT * FROM customer WHERE id_user = $user_id";
$checkCustomerResult = mysqli_query($db, $QuerycheckCustomer);

// Jika data untuk id_user tersebut belum ada, maka lakukan INSERT
if (mysqli_num_rows($checkCustomerResult) == 0) {
    
echo '<script type="text/javascript">'; 
        echo 'alert("Kamu belum Mengisi Profil!,Silahkan Isi Profile Terlebih Dahulu");'; 
        echo 'window.location= "profile.php"';
        echo '</script>'; 

    // Tambahkan logika atau tindakan lain yang sesuai kebutuhan
} else {
    // Jika data untuk id_user tersebut sudah ada, berikan logika
    
   echo " <script>alert('Kamu Sudah Mengisi Profil!,Silahkan Lanjut Membayar')</script>";
}


$enable_payments = array('gopay');


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


// Display the available payment methods
// echo "Available Payment Methods: \n";
// print_r($paymentMethods);
// Redirect to Midtrans payment page
// header("Location: https://app.sandbox.midtrans.com/snap/snap.js?snap_token=$snapToken");
// exit();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran || NazahPhone</title>
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

                        $user_id = $_SESSION['id_user'];
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


                        // Menampilkan detail data customer
                        echo "<p><strong>First Name:</strong> " . $n['nama'] . "</p>";
                        echo "<p><strong>Email:</strong> " . $n['email'] . "</p>";
                        echo "<p><strong>Phone:</strong> " . $n['phone'] . "</p>";
                        echo "<p><strong>Address:</strong> " . $n['detail_alamat'] . "</p>";
                        echo "<p><strong>City:</strong> " . $n['kota'] . "</p>";
                        echo "<p><strong>Postal Code:</strong> " . $n['kode_pos'] . "</p>";
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
                                    <th scope="col">ID Produk</th>
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
                                $idproduk = $_POST['product_id'];
                                $namaproduk = $_POST['nama_produk'];
                                $jumlah = $_POST['quantity'];
                                $gambar = $_POST['gambar'];

                                $harga = $_POST['harga_produk'];
                                $total_harga += $harga * $jumlah;
                                ?>
                                <tr>
                                    <td><?php echo $idproduk ?> </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="admin/image/<?php echo $gambar ?>" alt="Product Image" class="img-thumbnail me-2" style="width: 120px; height: 120px;">
                                            <div>
                                                <div><?php echo $namaproduk ?></div>
                                                <small class="text-muted">Variasi</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp.<?php echo number_format($harga) ?></td>
                                    <td> <?php echo  $jumlah ?> </td>
                                    <td>Rp.<?php echo  number_format($harga * $jumlah) ?></td>
                                </tr>
                                <?php
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span>Total (<?php echo $no + 1; ?> Produk): Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                        <button class="btn btn-success text-lg-center" id="pay-button">Bayar!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-sm">
    <a href="detail1.php" class="btn btn-outline-primary">Kembali</a>
    </div>
    <br>
    <br>
   
    
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snapToken ?>'), {
                // Optional
                onSuccess: function(result) {
                    <?php
                    $update_product_sql = "UPDATE produk SET stok = stok - $jumlah, terjual = terjual + $jumlah WHERE id_produk = '$idproduk'";
                    mysqli_query($db, $update_product_sql);
                    ?>
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
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
</body>

</html>