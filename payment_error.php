<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Payment Error</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-danger">Payment Error</h3>
                        <?php
                            $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
                            $status_code = isset($_GET['status_code']) ? $_GET['status_code'] : '';
                            $transaction_status = isset($_GET['transaction_status']) ? $_GET['transaction_status'] : '';

                            echo '<p><strong>Order ID:</strong> ' . $order_id . '</p>';
                            echo '<p><strong>Status Code:</strong> ' . $status_code . '</p>';
                            echo '<p><strong>Transaction Status:</strong> ' . $transaction_status . '</p>';
                        ?>
                        <p class="text-muted">There was an error processing your payment. Please try again later or contact customer support.</p>
                        <a href="index.php" class="btn btn-primary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
