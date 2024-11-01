<?php include 'koneksi.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <h2>Order Status</h2>
        <?php
            // Ambil nilai dari parameter URL
            $order_id = $_GET['order_id'];
            $status_code = $_GET['status_code'];
            $transaction_status = $_GET['transaction_status'];
        ?>
        
        <p>Order ID: <?php echo $order_id ?></p>
        <p>Status Code: <?php echo $status_code ?></p>

        <?php if($transaction_status == 'settlement') { ?>
            <div class="alert alert-success text-center" id="successStatus">Transaction Status: SUKSES</div>

            <script>
                // Tambahkan animasi untuk status "sukses" menggunakan JavaScript
                var successStatus = document.getElementById('successStatus');
                setInterval(function() {
                    successStatus.classList.toggle('animate__bounce');
                }, 1000); // Ganti 1000 dengan durasi animasi dalam milidetik
            </script>
        <?php } elseif($transaction_status == 'pending') { ?>
            <div class="alert alert-warning text-center" id="pendingStatus">Transaction Status: PENDING</div>

            <script>
                // Tambahkan animasi untuk status "pending" menggunakan JavaScript
                var pendingStatus = document.getElementById('pendingStatus');
                setInterval(function() {
                    pendingStatus.classList.toggle('animate__flash');
                }, 1000); // Ganti 1000 dengan durasi animasi dalam milidetik
            </script>
        <?php } else { ?>
            <div class="alert alert-danger text-center">Transaction Status: GAGAL</div>
        <?php } ?>
    

    <!-- Tambahkan animasi CSS menggunakan library animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <div class="text-start">
<a class="btn btn-outline-primary" href="jajal.php">Kembali Ke Beranda</a>
</div>
</div>
</body>
</html>
