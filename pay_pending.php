<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Query to retrieve pending transaction details
    $pending_transaction_sql = "SELECT * FROM transaksi WHERE order_id = '$order_id' AND status_pembayaran = 'pending'";
    $pending_transaction_query = mysqli_query($db, $pending_transaction_sql);
    $row = mysqli_fetch_assoc($pending_transaction_query);

    if ($row) {
        // Display the pending transaction details
        echo '<div class="container mt-3">';
        echo '<h2>Pending Transaction Details</h2>';
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Order ID: ' . $row['order_id'] . '</h5>';
        echo '<p class="card-text">Tanggal Pesan: ' . $row['tanggal_pesan'] . '</p>';
        echo '<p class="card-text">Total Amount: Rp ' . number_format($row['total_harga'], 0, ',', '.') . '</p>';
        echo '<p class="card-text">Status: ' . $row['status_pembayaran'] . '</p>';
        
        // Add a button to allow the user to pay for the pending transaction
        echo '<a href="process_payment.php?order_id=' . $row['order_id'] . '" class="btn btn-primary">Proceed to Payment</a>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        // If the order is not found or not pending, display an error message
        echo '<div class="container mt-3">';
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Invalid or non-pending order.';
        echo '</div>';
        echo '</div>';
    }
} else {
    // If the request method is not GET or order_id is not set, display an error message
    echo '<div class="container mt-3">';
    echo '<div class="alert alert-danger" role="alert">';
    echo 'Invalid request.';
    echo '</div>';
    echo '</div>';
}
?>
