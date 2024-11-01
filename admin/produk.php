<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Produk</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home-section">
        <div class="text">Produk</div>

        <div class="container">
        <?php 
          
        //   if($_SESSION['status']!= "login" ){
        //     header("location:admin_login.php?pesan=belum_login");
        // }
     ?>
            <div class="panel">
                <div class="panel-handling">
                    <h4>Data Produk</h4>
                </div>
                <div class="panel-body">

                    <a href="produk_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>

                    <br>
                    <br>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Produk</th>
                                <th>Brand</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th width="15%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "koneksi.php";
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM produk order by nama_produk asc");
                            while ($d = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $d['nama_produk']; ?></td>
                                    <td><?php echo $d['brand']; ?></td>
                                    <td><?php echo number_format($d['harga_produk']); ?></td>
                                    <td><?php echo $d['stok']; ?></td>
                                    <td><img src="image/<?php echo $d['gambar_a'] ?>" width="100px" alt="foto"></td>

                                    <td>
                                        <a href="produk_hapus.php?id_produk=<?php echo $d['id_produk']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                        <a href="produk_detail.php?id_produk=<?php echo $d['id_produk']; ?>" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
    <script src="script.js"></script>
    <!-- Add any additional JavaScript scripts here if needed -->
</body>

</html>
