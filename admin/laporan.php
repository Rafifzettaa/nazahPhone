<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script>
        src = "assets/js/jquery.js"
    </script>
    <script src="assets/js/bootstrap.js"></script>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home-section">
        <div class="text">Laporan</div>

        <div class="container">
            <div class="panel">
                <div class="panel-handling">
                </div>
                <div class="panel-body">

                    <form action="laporan.php" method="get">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th width="%1"></th>
                            </tr>
                            <tr>
                                <td>
                                    <br />
                                    <input type="date" name="dari" class="form-control">
                                </td>
                                <td>
                                    <br />
                                    <input type="date" name="sampai" class="form-control">
                                    <br />
                                </td>
                                <td>
                                    <br />
                                    <input type="submit" class="btn btn-primary" value="Filter">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <br>

            <?php
            if (isset($_GET['dari']) && isset($_GET['sampai'])) {
                $dari = $_GET['dari'];
                $sampai = $_GET['sampai'];
            ?>
                <div class="panel">
                    <div class="panel-heading">
                        <h4>Data Laporan Penjualan dari <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
                    </div>
                    <div class="panel-body">
                        <a target="_blank" href="laporan_aksi.php?dari=<?php echo $dari; ?>&sampai=<?php echo $sampai; ?>" class="btn btn-sm btn-primary">
                            <i class="glyphicon glyphicon-print"></i> CETAK
                        </a>
                        <br />
                        <br />
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="1%">No</th>
                                <th>Order Id</th>
                                <th>Nama Customer</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Produk</th>
                                <th>Brand</th>
                                <!--<th>Jumlah (pcs)</th<-->
                                <th>Total Harga</th>
                            </tr>

                            <?php
                            include 'koneksi.php';
                            //mengambil data pelanggan dari database
                            $data = mysqli_query(
                                $koneksi,
                                " SELECT  
                                transaksi.order_id,
                                transaksi.tanggal_pesan,
                                transaksi.total_harga,
                                customer.nama,
                                produk.nama_produk,
                                produk.brand
                                FROM 
                                transaksi 
                                JOIN 
                                customer 
                                ON transaksi.id_user = customer.id_user
                                JOIN  
                                pemesanan 
                                ON transaksi.id_order = pemesanan.id_order
                                JOIN 
                                produk
                                ON pemesanan.id_produk = produk.id_produk
            

                                WHERE DATE(transaksi.tanggal_pesan) BETWEEN '$dari' AND '$sampai' 
                                ORDER BY transaksi.id_order DESC"
                            );
                            $no = 1;
                            //mengbah data array ke data menampilkannya dengan perulangan while
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $d['order_id']; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['tanggal_pesan']; ?></td>
                                    <td><?php echo $d['nama_produk']; ?></td>
                                    <td><?php echo $d['brand']; ?></td>
                                    <td><?php echo "Rp." . number_format($d['total_harga']) . ",-"; ?></td>
                                    
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>

            <?php } ?>

        </div>
    </section>

</body>

</html>