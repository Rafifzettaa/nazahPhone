<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';
require_once 'vendor/autoload.php'; // Include Composer autoloader

use GuzzleHttp\Client; // Include GuzzleHttp\Client

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['order_id'])) {
    $order_id = mysqli_real_escape_string($db, $_GET['order_id']);

    // Query to retrieve pending transaction details
    $pending_transaction_sql = "SELECT * FROM transaksi WHERE order_id = '$order_id' AND status_pembayaran = 'pending'";
    $pending_transaction_query = mysqli_query($db, $pending_transaction_sql);
    $row = mysqli_fetch_assoc($pending_transaction_query);
    $total_harga = $row['total_harga'];

    if ($row) {
        // Display the pending transaction details
        echo '<div class="container mt-3">';
        echo '<h2>Payment Process</h2>';
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Order ID: ' . $row['order_id'] . '</h5>';
        echo '<p class="card-text">Total Amount: Rp ' . number_format($row['total_harga'], 0, ',', '.') . '</p>';

        // Payment processing logic starts here
        $user_id = $_SESSION['id_user'];
$order_id = uniqid('NAZAH-');


        // Check if the payment is pending and has not been successfully paid
        if ($row['status_pembayaran'] === 'pending' && $row['status'] !== 'success') {
            // Call Midtrans API to cancel the transaction
            $cancel_endpoint = 'https://api.sandbox.midtrans.com/v2/' . $order_id . '/cancel';

            $client = new Client(); // Create a new instance of GuzzleHttp\Client

            try {
                $response = $client->request('POST', $cancel_endpoint, [
                    'headers' => [
                        'accept' => 'application/json',
                        'authorization' => 'Basic U0ItTWlkLXNlcnZlci1uSFo0a2Vkc0VfeEk4VGNSWmZLSWZtekE6UmFmaWYxMjM=',
                    ],
                ]);

                $cancel_response = json_decode($response->getBody(), true);

                // Check the cancellation response and handle accordingly
                if (isset($cancel_response['status']) && $cancel_response['status'] === 'success') {
                    // Transaction successfully canceled, you can re-use the existing order_id
                    // Do not generate a new $order_id here
                } else {
                    // Transaction cancellation failed, handle the error
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Transaction cancellation failed. Please try again later.';
                    echo '</div>';
                    // Optionally, you may want to exit the script or take appropriate action
                    exit;
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // Handle exceptions if the request to cancel fails
                echo '<div class="alert alert-danger" role="alert">';
                echo 'Error canceling the transaction. Please try again later.';
                echo '</div>';
                // Optionally, you may want to exit the script or take appropriate action
                exit;
            }
        }

        // Continue with the rest of your payment processing logic
        // Setelah selesai, Anda dapat mengarahkan pengguna ke halaman pembayaran Midtrans

        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Set Your server key
        Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
        $clientKey = $_ENV['MIDTRANS_CLIENT_KEY'];

        // Enable sanitization
        Midtrans\Config::$isSanitized = true;

        // Enable 3D-Secure
        Midtrans\Config::$is3ds = true;
        $item_details = array();
        $keranjang_query = mysqli_query($db, "SELECT * FROM keranjang WHERE id_user = '$user_id'");
        while ($ro = mysqli_fetch_assoc($keranjang_query)) {
            $item_details[] = array(
                'id' => $ro['id_produk'],
                'price' => $ro['harga_produk'],
                'quantity' => $ro['jumlah_produk'],
                'name' => $ro['nama_produk']
            );
        }

        $billings = array();
        $billing = mysqli_query($db, "SELECT customer.nama, alamat.detail_alamat, alamat.kota, alamat.kode_pos, alamat.no_hp
        FROM customer
       JOIN alamat ON customer.id_alamat = alamat.id_alamat
        WHERE customer.id_user = $user_id");

// Check if the query was successful
if ($billing) {
    while ($bil = mysqli_fetch_assoc($billing)) {
        $billing_address = array(
            'first_name'    => $bil['nama'],
            'address'       => $bil['detail_alamat'],
            'city'          => $bil['kota'],
            'postal_code'   => $bil['kode_pos'],
            'phone'         => $bil['no_hp']
        );
    }
} else {
    // Handle the query error
    echo 'MySQL Error: ' . mysqli_error($db);
}
        // Ambil data pelanggan dari database
        $customer = array();
        $customersql = mysqli_query($db,
            "SELECT user.email, customer.nama, customer.phone
        FROM user
        JOIN customer ON user.id_user = customer.id_user
        WHERE user.id_user = $user_id;");
        while ($cust = mysqli_fetch_assoc($customersql)) {
            $customer_details = array(
                'first_name'    => $cust['nama'],
                'email'         => $cust['email'],
                'phone'         => $cust['phone'],
                'billing_address'  => $billing_address,
                'shipping_address' => $billing_address
            );
        }

        //memilih metode pembayaran
        $enable_payments = array('credit_card', 'gopay', 'shopeepay');
        $transaction_details = array(
            'order_id' => $order_id,
            'gross_amount' => $total_harga, // Sesuaikan dengan total harga pesanan
        );

        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        // For demonstration purposes, let's assume the payment is successful
        $snapToken = Midtrans\Snap::getSnapToken($transaction);

        // Update the order status in the database
        $update_order_sql = "UPDATE transaksi SET status = 'success' WHERE order_id = '$order_id'";
        $result = mysqli_query($db, $update_order_sql);

        if (!$result) {
            // If there's an error in updating the order status, handle it
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Error updating order status.';
            echo '</div>';
        } else {
            // Payment is successful, update the payment status in the database
            $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'success' WHERE order_id = '$order_id'";
            mysqli_query($db, $update_payment_status_sql);
            ?>
            <button id="pay-button">PAY</button>
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo $clientKey; ?>"></script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function() {
                    // SnapToken acquired from the previous step
                    snap.pay('<?php echo $snapToken ?>'), {
                        // Optional
                        onSuccess: function(result) {
                            window.location.href = 'payment_sukses.php';
                        },
                        // Optional
                        onPending: function(result) {
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                            document.getElementById('result-json').innerHTML += '<div class="alert alert-danger" ><br>Pembayaran belum diproses. Silakan cek kembali nanti.</div>';
                        },
                        // Optional
                        onError: function(result) {
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        },
                    };
                };
            </script>
            <?php
            echo '<div class="alert alert-success" role="alert">';
            echo 'Payment successful. Thank you!';
            echo '</div>';
        }

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
