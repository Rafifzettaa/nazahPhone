<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST['id_produk'];
    $jumlah_produk = $_POST['jumlah_produk'];

    // Validate and sanitize input if needed

    // Perform the update in the database
    $updateSql = "UPDATE keranjang_belanja SET jumlah_produk = '$jumlah_produk' WHERE id_produk = '$id_produk'";
    $updateQuery = mysqli_query($db, $updateSql);

    if ($updateQuery) {
        // Query executed successfully, calculate and return updated total price
        $totalHarga = calculateTotalHarga($db, $_SESSION['id_user']); // Pass $user_id to the function
        echo $totalHarga;
    } else {
        // Query failed
        echo "Gagal melakukan update: " . mysqli_error($db);
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}

function calculateTotalHarga($db, $user_id) {
    // Implement your logic to calculate total price here
    // For example, querying the database again based on the updated data
    $sql = "SELECT SUM(produk.harga_produk * keranjang_belanja.jumlah_produk) AS total 
            FROM keranjang_belanja
            JOIN produk ON keranjang_belanja.id_produk = produk.id_produk
            WHERE keranjang_belanja.id_user = '$user_id'";
    $result = mysqli_query($db, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        // Query failed
        return "Gagal menghitung total harga: " . mysqli_error($db);
    }
}
?>
