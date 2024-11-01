<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <h4>Tambah Pelanggan Baru</h4>
            </div>
            <div class="panel-body">

                <form method="post" action="pengguna_aksi.php " enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email-text" class="form-control" name="email" placeholder="Masukkan email...">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Masukkan username anda">
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan unama lengkap anda">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="jenis_kelamin" placeholder="Masukkan jenis kelamin...">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" placeholder="Masukkan tanggal lahir...">
                    </div>
                    <div class="form-group">
                        <label>HP</label>
                        <input type="number" class="form-control" name="phone" placeholder="Masukkan No.Hp...">
                    </div>
                    <div class="form-group">
                        <label>No HP Penerima</label>
                        <input type="number" class="form-control" name="no_hp" placeholder="Masukkan No.Hp...">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password...">
                    </div>
                    <div class="form-group">
                        <label>Detail Alamat</label>
                        <textarea class="form-control" name="detail_alamat" id="" placeholder="Detail alamat...."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" class="form-control" name="kota" placeholder="Kabupaten...">
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos...">
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input type="text" class="form-control" name="provinsi" placeholder="Provinsi...">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    <a href="pengguna.php"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
                </form>
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php';?>