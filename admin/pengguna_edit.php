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
                <h4>Edit Pelanggan</h4>
            </div>
            <div class="panel-body">
                <?php
                include "koneksi.php";

                $id = $_GET['id'];
                $data = mysqli_query($koneksi, "SELECT  
    user.id_user,
    user.email,
    user.username,
    user.password,
    customer.id_customer,
    customer.nama,
    customer.jenis_kelamin,
    customer.tanggal_lahir,
    customer.phone,
    alamat.no_hp,
    alamat.id_alamat,
    alamat.detail_alamat,
    alamat.kota,
    alamat.provinsi,
    alamat.kode_pos
FROM 
    customer
JOIN 
    alamat ON customer.id_alamat = alamat.id_alamat
JOIN 
    user ON customer.id_user = user.id_user
WHERE 
    customer.id_customer = '$id'");  while ($d = mysqli_fetch_array($data)) {

                 ?>
                    <form method="post" action="pengguna_update.php">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="hidden" name="id" value="<?php echo $d['id_user']; ?>">
                            <input type="email" class="form-control" name="email" placeholder="Masukkan email..." value="<?php echo $d['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Masukkan username anda" value="<?php echo $d['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>

                            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap anda" value="<?php echo $d['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin" placeholder="Masukkan jenis kelamin..." value="<?php echo $d['jenis_kelamin']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" placeholder="Masukkan tanggal lahir..." value="<?php echo $d['tanggal_lahir']; ?>">
                        </div>
                        <div class="form-group">
                            <label>HP</label>
                            <input type="number" class="form-control" name="phone" placeholder="Masukkan No.Hp..." value="<?php echo $d['phone']; ?>">
                        </div>
                        <div class="form-group">
                            <label>No HP Penerima</label>
                            <input type="number" class="form-control" name="no_hp" placeholder="Masukkan No.Hp..." value="<?php echo $d['no_hp']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password..." value="<?php echo $d['password']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Detail Alamat</label>
                            <input type="hidden" name="id_alamat" value="<?php echo $d['id_alamat']; ?>">
                            <textarea class="form-control" name="detail_alamat" id="" placeholder="Detail alamat...."><?php echo $d['detail_alamat']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kabupaten/Kota</label>
                            <input type="text" class="form-control" name="kota" placeholder="Kabupaten/Kota..." value="<?php echo $d['kota']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos..." value="<?php echo $d['kode_pos']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" class="form-control" name="provinsi" placeholder="Provinsi..." value="<?php echo $d['provinsi']; ?>">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                        <a href="pengguna.php"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
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