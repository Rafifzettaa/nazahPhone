<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Pengguna</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
</body>

</html>
<?php include 'sidebar.php'; ?>
<div class="container">
    <br><br><br>
    <div class="col-md-5 col-md-offset-3">
        <div class="panel">
            <div class="panel-handling">
                <h4>Detail Data Produk</h4>
            </div>
            <div class="panel-body">
                <?php
                include "koneksi.php";
                $id = $_GET['id_produk'];
                        $data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id'");
                        while ($d = mysqli_fetch_array($data)) {
                ?>
                <a href="produk.php"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
                <a href="produk_edit.php?id_produk=<?php echo $d['id_produk']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <br>
                <br>
               <table class="table table-striped" >
                        <tr>
                            <td>Nama Produk</td>
                            <td><?php echo $d['nama_produk']; ?></td>
                        </tr>
                        <tr>
                            <td>Brand</td>
                            <td><?php echo $d['brand']; ?></td>
                        </tr>
                        <tr>
                            <td>Harga Produk</td>
                            <td><?php echo $d['harga_produk']; ?></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td><?php echo $d['diskon']; ?></td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td><?php echo $d['stok']; ?></td>
                        </tr>
                        <tr>
                            <td>Terjual</td>
                            <td><?php echo $d['terjual']; ?></td>
                        </tr>
                        <tr>
                            <td>Deskripsi Produk</td>
                            <td><?php echo $d['deskripsi_produk']; ?></td>
                        </tr>
                        <tr>
                            <td>Gambar 1</td>
                            <td><img src="image/<?php echo $d['gambar_a'] ?>" width="150px" alt="foto"></td>
                        </tr>
                        <tr>
                            <td>Gambar 2</td>
                            <td><img src="image/<?php echo $d['gambar_b'] ?>" width="150px" alt="foto"></td>
                        </tr>
                        <tr>
                            <td>Gambar 3</td>
                            <td><img src="image/<?php echo $d['gambar_c'] ?>" width="150px" alt="foto"></td>
                        </tr>
                        <tr>
                            <td>Ukuran Layar</td>
                            <td><?php echo $d['ukuran_layar']; ?></td>
                        </tr>
                        <tr>
                            <td>Resolusi Kamera</td>
                            <td><?php echo $d['resolusi_kamera']; ?></td>
                        </tr>
                        <tr>
                            <td>Kapasitas Penyimpanan</td>
                            <td><?php echo $d['k_penyimpanan']; ?></td>
                        </tr>
                        <tr>
                            <td>RAM</td>
                            <td><?php echo $d['ram']; ?></td>
                        </tr>
                        <tr>
                            <td>Fitur Handphone</td>
                            <td><?php echo $d['fitur_handphone']; ?></td>
                        </tr>
                        <tr>
                            <td>Tipe Processor</td>
                            <td><?php echo $d['tipe_processor']; ?></td>
                        </tr>
                        <tr>
                            <td>Kapasitas Baterai</td>
                            <td><?php echo $d['k_baterai']; ?></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    
                    <br>
                    <div class="clearfix" style="padding-top:16%;"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>