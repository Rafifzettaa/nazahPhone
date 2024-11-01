<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Transactions</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3">
    <h2>Pending Transactions</h2>
    
    <!-- Display pending transactions here -->
    <?php
    include 'koneksi.php'; // Include your database connection file
session_start();
    $user_id = $_SESSION['id_user'];

    // Query to retrieve pending transactions for the user
    $pending_transactions_sql = "SELECT * FROM transaksi WHERE id_user = '$user_id' AND status_pembayaran = 'pending'";
    $pending_transactions_query = mysqli_query($db, $pending_transactions_sql);

    while ($row = mysqli_fetch_assoc($pending_transactions_query)) {
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Order ID: ' . $row['order_id'] . '</h5>';
        echo '<p class="card-text">Total Amount: Rp ' . number_format($row['total_harga'], 0, ',', '.') . '</p>';
        echo '<p class="card-text">Status: ' . $row['status_pembayaran'] . '</p>';
        
        // Add a button to allow the user to pay for the pending transaction
        echo '<a href="pay_pending.php?order_id=' . $row['order_id'] . '" class="btn btn-primary">Pay Now</a>';
        
        echo '</div>';
        echo '</div>';
    }
    ?>
    
</div>

<!-- Include Bootstrap JS and any other scripts if needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
