<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data pengguna</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>

    <?php include 'sidebar.php'; ?>
    <section>
        <div class="container">
            <br><br><br>
            <div class="col-md-5 col-md-offset-3">
                <div class="panel">
                    <div class="panel-handling">
                        <h4>Edit Produk</h4>
                    </div>
                    <div class="panel-body">
                        <?php
                        include "koneksi.php";

                        $id = $_GET['id_produk'];
                        $data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id'");
                        while ($d = mysqli_fetch_array($data)) {

                        ?>
                            <form method="post" action="produk_update.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="hidden" name="id_produk" value="<?php echo $d['id_produk']; ?>">
                                    <input type="text" class="form-control" name="nama_produk" placeholder="Nama produk..." value="<?php echo $d['nama_produk']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <input type="text" class="form-control" name="brand" placeholder="Brand" value="<?php echo $d['brand']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Harga Produk</label>
                                    <input type="number" class="form-control" name="harga" placeholder="Harga Produk" value="<?php echo $d['harga_produk']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Diskon</label>
                                    <input type="text" class="form-control" name="diskon" placeholder="Masukkan angkanya saja" value="<?php echo $d['diskon']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" class="form-control" name="stok" placeholder="Stok Produk" value="<?php echo $d['stok']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Terjual</label>
                                    <input type="text" class="form-control" name="terjual" placeholder="Terjual" value="<?php echo $d['terjual']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <textarea class="form-control" name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk"><?php echo $d['deskripsi_produk']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Gambar 1</label>
                                    <input type="file" class="form-control" name="foto1" value="<?php echo $d['gambar_a']; ?>">
                                    <?php if (!empty($d['gambar_a'])) : ?>
                                        <p class="mt-2">Gambar Saat Ini: <?php echo "<img src='image/$d[gambar_a]' width=100 height=150>"; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Gambar 2</label>
                                    <input type="file" class="form-control" name="foto2" value="<?php echo $d['gambar_b']; ?>">
                                    <?php if (!empty($d['gambar_b'])) : ?>
                                        <p class="mt-2">Gambar Saat Ini: <?php echo "<img src='image/$d[gambar_b]' width=100 height=150>"; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Gambar 3</label>
                                    <input type="file" class="form-control" name="foto3" value="<?php echo $d['gambar_c']; ?>">
                                    <?php if (!empty($d['gambar_c'])) : ?>
                                        <p class="mt-2">Gambar Saat Ini: <?php echo "<img src='image/$d[gambar_c]' width=100 height=150>"; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Ukuran Layar</label>
                                    <input type="text" class="form-control" name="ukuran_layar" placeholder="ukuran layar" value="<?php echo $d['ukuran_layar']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Resolusi Kamera</label>
                                    <input type="text" class="form-control" name="resolusi_kamera" placeholder="Resolusi Kamera" value="<?php echo $d['resolusi_kamera']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kapasitas Penyimpanan</label>
                                    <input type="text" class="form-control" name="k_penyimpanan" placeholder="Kapasitas Penyimpanan" value="<?php echo $d['k_penyimpanan']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>RAM</label>
                                    <input type="text" class="form-control" name="ram" placeholder="Ram" value="<?php echo $d['ram']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Fitur Handphone</label>
                                    <input type="text" class="form-control" name="fitur_handphone" placeholder="Fitur Handphone" value="<?php echo $d['fitur_handphone']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tipe Processor</label>
                                    <input type="text" class="form-control" name="tipe_processor" placeholder="Tipe Processor" value="<?php echo $d['tipe_processor']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kuantitas Baterai</label>
                                    <input type="text" class="form-control" name="k_baterai" placeholder="Kuantitas Baterai" value="<?php echo $d['k_baterai']; ?>">
                                </div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a href="produk.php"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
</body>

</html>