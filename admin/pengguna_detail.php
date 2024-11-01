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
                <h4>Detail Data Pelanggan</h4>
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
customer.id_customer = '$id'");
                while ($d = mysqli_fetch_array($data)) { ?>
                    <a href="pengguna.php"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali </button></a>
                    <a href="pengguna_edit.php?id=<?php echo $d['id_customer']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <br>
                    <br>
                    
                    <table class="table table-striped">
                        <tr>
                            <td>Email</td>
                            <td><?php echo $d['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?php echo $d['username']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><?php echo $d['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td><?php echo $d['jenis_kelamin']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td><?php echo $d['tanggal_lahir']; ?></td>
                        </tr>
                        <tr>
                            <td>No Hp Pengguna</td>
                            <td><?php echo $d['phone']; ?></td>
                        </tr>
                        <tr>
                            <td>No HP Penerima</td>
                            <td><?php echo $d['no_hp']; ?></td>
                        </tr>
                        <tr>
                            <td>Detail Alamat</td>
                            <td><?php echo $d['detail_alamat']; ?></td>
                        </tr>
                        <tr>
                            <td>Kabupaten/Kota</td>
                            <td><?php echo $d['kota']; ?></td>
                        </tr>
                        <tr>
                            <td>Kode Pos</td>
                            <td><?php echo $d['kode_pos']; ?></td>
                        </tr>
                        <tr>
                            <td>Provinsi</td>
                            <td><?php echo $d['provinsi']; ?></td>
                        </tr>
                    </table>

                    <br>
                    <div class="clearfix" style="padding-top:16%;"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>