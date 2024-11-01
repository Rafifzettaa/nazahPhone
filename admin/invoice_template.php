<?php include '../koneksi.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
<div class="container-sm">
<?php
            // Tambahkan data transaksi ke dalam tabel
            // Fetch the transaction details with user information
    $id = $_GET['id_transaksi'];
    $query = "SELECT t.*, c.nama, c.phone, a.detail_alamat
          FROM transaksi t
          JOIN customer c ON t.id_user = c.id_user
          JOIN alamat a ON c.id_alamat = a.id_alamat
          WHERE t.id_order = $id";
    $result = mysqli_query($db, $query);
    $t = mysqli_fetch_assoc($result);
?>
    <div class="logo"><img src="../assets/NP.png"  class="img-fluid w-25" alt="Logo NazahPhone"></div>
    <h1 class="mb-4">NazahPhone Invoice</h1>
    <div class="invoice-details">
        <div>
            <p><strong>Nama Pembeli:</strong> <?php echo $t['nama']; ?></p>
            <p><strong>No HandPhone:</strong> <?php echo $t['phone']; ?></p>
            <p><strong>Alamat:</strong> <?php echo $t['detail_alamat']; ?></p>
            <p><strong>Status Pembayaran:</strong> <?php echo $t['status']; ?></p>
        </div>
        <div>
            <h3 class="mb-0">Invoice</h3>
            <p class="mb-0"><strong><?php echo $t['order_id']; ?></strong></p>
        </div>
    </div>
    <table class="table table-responsive table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah Beli</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Tambahkan data transaksi ke dalam tabel
            $sql = "SELECT t.*, c.nama AS nama_customer, 
                    p.id_produk,
                    produk.nama_produk,
                    produk.harga_produk,
                    p.jumlah_produk
                    FROM transaksi t
                    INNER JOIN customer c ON t.id_user = c.id_user
                    INNER JOIN pemesanan p ON t.id_order = p.id_order
                    INNER JOIN produk ON p.id_produk = produk.id_produk";
            $queryData = mysqli_query($db, $sql);

            while ($d = mysqli_fetch_assoc($queryData)) {
                echo '<tr class="text-center">
                        <td>' . $d['nama_produk'] . '</td>
                        <td>' . $d['jumlah_produk'] . '</td>
                        <td>Rp. ' . number_format($d['harga_produk']) . ' ,-</td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="total-payment">
        <p><strong>Total Pembayaran:</strong> Rp. <?php echo number_format($t['total_harga']); ?> ,-</p>
    </div>
    <hr>
    <p class="mb-0"><strong>Tanggal Pesan:</strong> <?php echo $t['tanggal_pesan']; ?></p>
</div>
</body>
</html>