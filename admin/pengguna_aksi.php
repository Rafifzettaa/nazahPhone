<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $email = mysqli_real_escape_string($koneksi, $_POST["email"]);
    $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST["jenis_kelamin"]);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST["tanggal_lahir"]);
    $phone = mysqli_real_escape_string($koneksi, $_POST["phone"]);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST["no_hp"]);
    $password = mysqli_real_escape_string($koneksi, md5($_POST["password"]));
    $detail_alamat = mysqli_real_escape_string($koneksi, $_POST["detail_alamat"]);
    $kota = mysqli_real_escape_string($koneksi, $_POST["kota"]);
    $kode_pos = mysqli_real_escape_string($koneksi, $_POST["kode_pos"]);
    $provinsi = mysqli_real_escape_string($koneksi, $_POST["provinsi"]);

    // Simpan data ke tabel pengguna
    $query_pengguna = "INSERT INTO user (username, email, password) 
                       VALUES ('$username', '$email', '$password')";
    mysqli_query($koneksi, $query_pengguna);

    // Dapatkan ID pengguna yang baru saja dimasukkan
    $id_pengguna = mysqli_insert_id($koneksi);

    // Simpan data ke tabel alamat_pembayaran
    $query_alamat = "INSERT INTO alamat (detail_alamat, kota, kode_pos, provinsi,no_hp) 
                     VALUES ('$detail_alamat', '$kota', '$kode_pos', '$provinsi','$no_hp')";
    mysqli_query($koneksi, $query_alamat);

    // Dapatkan ID alamat_pembayaran yang baru saja dimasukkan
    $id_alamat = mysqli_insert_id($koneksi);

    // Simpan data ke tabel data_customer
    $query_data_customer = "INSERT INTO customer (id_user, id_alamat, nama, jenis_kelamin, tanggal_lahir, phone) 
                            VALUES ('$id_pengguna', '$id_alamat', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$phone')";
    mysqli_query($koneksi, $query_data_customer);

    header("location:pengguna.php");
}
?>
