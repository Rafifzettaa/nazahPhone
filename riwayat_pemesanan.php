<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Riwayat Pembayaran</title>
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
<div class="container">
<!-- Your existing navigation or header code goes here -->
<div class="card" style="width: 18rem;">
  <div class="card-body">
<div class="container mt-4">
    <h2>Riwayat Pembayaran</h2>
    <?php
    // Process the URL parameters
    $order_id = $_GET['order_id'];
    $status_code = $_GET['status_code'];
    $transaction_status = $_GET['transaction_status'];

    // Display the information
    echo "<p>Order ID: $order_id</p>";
    echo "<p>Status Code: $status_code</p>";
    echo "<p>Transaction Status: $transaction_status</p>";

    // Check transaction status and display corresponding message
    if ($transaction_status === 'capture' || $transaction_status === 'settlement') {
        echo '<p class="text-success">Pembayaran Berhasil!</p>';
    } else {
        echo '<p class="text-danger">Pembayaran Gagal.</p>';
    }
    ?>
    <!-- Add more content related to payment history if needed -->

    <!-- Back to Index button with an alias -->
    <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
  </div>
</div>
</div>




<!-- Your existing footer code goes here -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<!-- Add your custom scripts if needed -->

</body>
</html>
