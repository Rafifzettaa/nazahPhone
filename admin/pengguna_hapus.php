<?php 
//menggabungkan koneksi
include "koneksi.php";

//menangkap data id yang dikirim url
$id = $_GET['id'];

//menghapus data di tabel data_customer
mysqli_query($koneksi, "DELETE FROM customer WHERE id_customer='$id'");

//menghapus data di tabel pengguna (sesuai dengan desain tabel Anda)
mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");

//menghapus data di tabel alamat_pembayaran (sesuai dengan desain tabel Anda)
mysqli_query($koneksi, "DELETE FROM alamat WHERE id_alamat='$id_alamat'");

//alihkan halaman ke halaman pelanggan
header("location:pengguna.php");
?>
