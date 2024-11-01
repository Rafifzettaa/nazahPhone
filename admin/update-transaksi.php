<?php
// Replace these variables with your database credentials
include '../koneksi.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_order = $_POST['id_order'];

    // Retrieve other form data and update the corresponding columns
    // $order_id = $_POST['order_id'];
    $nama = $_POST['nama'];
    $alamat_pengiriman = $_POST['alamat_pengiriman'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $tanggal_pesan = $_POST['tanggal_pesan'];
    $status = $_POST['status'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $total_harga = $_POST['total_harga'];
       
       
    $sql = "UPDATE transaksi
    JOIN customer ON transaksi.id_user = customer.id_user
    SET 
    -- transaksi.order_id = '$order_id',
        customer.nama = '$nama',
        transaksi.alamat_pengiriman = '$alamat_pengiriman',
        transaksi.metode_pembayaran = '$metode_pembayaran',
        transaksi.tanggal_pesan = '$tanggal_pesan',
        transaksi.status = '$status',
        transaksi.status_pembayaran = '$status_pembayaran',
        transaksi.total_harga = '$total_harga'
    WHERE transaksi.id_order = $id_order";


    if ($db->query($sql) === TRUE) {

        echo "Record updated successfully";
        header('location:transaksi.php');
    } else {
        echo "Error updating record: " . $db->error;
    }
} else {
    echo "Invalid request";
}

// Close the connection
$db->close();
