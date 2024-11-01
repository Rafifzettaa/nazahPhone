<?php
session_start();
include 'koneksi.php';

$id = $_GET['id_produk'];
$sql = "DELETE FROM keranjang WHERE id_produk=$id";
$query = mysqli_query($db, $sql);

if ($query) {
    // melakukan cek apabila keranjang lebih besar dari 0 sebelum pengurangan 
    if (isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0) {
        $_SESSION['cart_count'] -= 1; // Kurangi perhitungan keranjang
    }
    header('location: keranjang.php?message=BERHASIL DIHAPUS!');
    exit();
} else {
    header('location: keranjangt.php?message=Gagal menghapus produk dari keranjang');
    exit();
}
?>
