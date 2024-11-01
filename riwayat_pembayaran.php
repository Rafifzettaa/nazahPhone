<?php
session_start();

// Include your database connection file
include 'koneksi.php';

// Check if the user is logged in
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("location: login.php");
    exit;
}

// Get the user ID from the session
$user_id = $_SESSION['id_user'];

// Fetch order history for the user
$sql = "SELECT * FROM transaksi WHERE id_user = '$user_id' ORDER BY tanggal_pesan DESC";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add your custom styles or link to your existing stylesheet -->
    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<!-- Your existing navigation or header code goes here -->

<div class="container mt-4">
    <h2>Order History</h2>

    <?php if ($result->num_rows > 0) : ?>
        <table class="table">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Amount</th>
                <th>Shipping Address</th>
                <th>Payment Method</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Action</th> <!-- Add this column for actions -->
                <!-- Add more columns if needed -->
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td>Rp.<?php echo number_format($row['total_harga']); ?></td>
                    <td><?php echo $row['alamat_pengiriman']; ?></td>
                    <td><?php echo $row['metode_pembayaran']; ?></td>
                    <td><?php echo $row['tanggal_pesan']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['status_pembayaran']; ?></td>
                    <td>
                        <?php if ($row['status_pembayaran'] === 'Pending') : ?>
                            <!-- Add a button to initiate payment for pending orders -->
                            <a href="process_payment.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-primary">Complete Payment</a>
                        <?php endif; ?>
                    </td>
                    <!-- Add more cells if needed -->
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No order history available.</p>
    <?php endif; ?>

    <!-- Back to Index button -->
    <a href="index.php" class="btn btn-primary mt-3">Kembali Ke Beranda</a>
</div>

<!-- Your existing footer code goes here -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<!-- Add your custom scripts if needed -->

</body>
</html>
