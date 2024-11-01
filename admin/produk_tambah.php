<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
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
                <h4>Tambah Produk Baru</h4>
            </div>
            <div class="panel-body">

            <form method="post" action="produk_aksi.php" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" class="form-control" name="nama_produk" id="nama_produk"  placeholder="Nama produk...">
    </div>
    <div class="form-group">
        <label>Brand</label>
        <input type="text" class="form-control" name="brand" id="brand"  placeholder="Brand">
    </div>
    <div class="form-group">
        <label>Harga Produk</label>
        <input type="number" class="form-control" name="harga_produk" id="harga_produk" placeholder="Harga Produk">
    </div>
    <div class="form-group">
        <label>Diskon</label>
        <input type="text" class="form-control" name="diskon" id="diskon" placeholder="Masukkan angkanya saja">
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok Produk">
    </div>
    <div class="form-group">
        <label>Terjual</label>
        <input type="text" class="form-control" name="terjual" id="terjual" placeholder="Terjual">
    </div>
    <div class="form-group">
        <label>Deskripsi Produk</label>
        <textarea class="form-control" name="deskripsi_produk" id="deskripsi_produk" placeholder="Masukkan Deskripsi Produk"></textarea>
    </div>
    <div class="form-group">
        <label>Gambar 1</label>
        <input type="file" class="form-control" name="foto1" id="foto1">
    </div>
    <div class="form-group">
        <label>Gambar 2</label>
        <input type="file" class="form-control" name="foto2" id="foto2">
    </div>
    <div class="form-group">
        <label>Gambar 3</label>
        <input type="file" class="form-control" name="foto3" id="foto3">
    </div>
    <div class="form-group">
        <label>Ukuran Layar</label>
        <input type="text" class="form-control" name="ukuran_layar" id="ukuran_layar" placeholder="ukuran layar">
    </div>
    <div class="form-group">
        <label>Resolusi Kamera</label>
        <input type="text" class="form-control" name="resolusi_kamera" id="resolusi_kamera" placeholder="Resolusi Kamera">
    </div>
    <div class="form-group">
        <label>Kapasitas Penyimpanan</label>
        <input type="text" class="form-control" name="k_penyimpanan" id="k_penyimpanan" placeholder="Kapasitas Penyimpanan">
    </div>
    <div class="form-group">
        <label>RAM</label>
        <input type="text" class="form-control" name="ram" id="ram" placeholder="Ram">
    </div>
    <div class="form-group">
        <label>Fitur Handphone</label>
        <input type="text" class="form-control" name="fitur_handphone" id="fitur_handphone" placeholder="Fitur Handphone">
    </div>
    <div class="form-group">
        <label>Tipe Processor</label>
        <input type="text" class="form-control" name="tipe_processor" id="tipe_processor" placeholder="Tipe Processor">
    </div>
    <div class="form-group">
        <label>Kuantitas Baterai</label>
        <input type="text" class="form-control" name="k_baterai" id="k_baterai" placeholder="Kuantitas Baterai">
    </div>   
    <br>
    <input type="submit" class="btn btn-primary" value="Simpan">
    <a href="produk.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
</form>

<script>
function validateForm() {
    const fields = [
        "nama_produk", "brand", "harga_produk", "diskon", "stok", "terjual", 
        "deskripsi_produk", "foto1", "foto2", "foto3", "ukuran_layar", 
        "resolusi_kamera", "k_penyimpanan", "ram", "fitur_handphone", 
        "tipe_processor", "k_baterai"
    ];
    
    for (let i = 0; i < fields.length; i++) {
        const field = document.getElementById(fields[i]);
        if (field && field.value === "") {
            alert("Field " + field.name + " harus diisi");
            field.focus();
            return false;
        }
    }
    return true;
}
</script>

<?php include 'footer.php';?>