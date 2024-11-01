<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $id_user = $_POST["id"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $phone = $_POST["phone"];
    $no_hp = $_POST["no_hp"];
    $password = $_POST["password"];
    $id_alamat = $_POST["id_alamat"];
    $detail_alamat = $_POST["detail_alamat"];
    $kota = $_POST["kota"];
    $kode_pos = $_POST["kode_pos"];
    $provinsi = $_POST["provinsi"];

    // Lakukan proses update ke database
    $query = "UPDATE user
              JOIN  customer ON user.id_user =  customer.id_user
              JOIN alamat  ON  customer.id_alamat  = alamat.id_alamat
              SET user.email = '$email',
                  user.username = '$username',
                  customer.nama = '$nama',
                customer.jenis_kelamin = '$jenis_kelamin',
                   customer.tanggal_lahir = '$tanggal_lahir',
                  customer.phone = '$phone',
                  alamat.no_hp = '$no_hp',
                  user.password = '$password',
                  alamat.detail_alamat = '$detail_alamat',
                  alamat.kota = '$kota',
                  alamat.kode_pos = '$kode_pos',
                  alamat.provinsi = '$provinsi'
              WHERE user.id_user = '$id_user'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data pengguna berhasil diupdate.";
        header("Location: pengguna.php"); // Redirect ke halaman pelanggan.php
    } else {
        echo "Gagal mengupdate data pengguna: " . mysqli_error($koneksi);
    }
}
