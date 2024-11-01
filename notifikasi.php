<?php
include 'koneksi.php'; // Sertakan file koneksi.php untuk menghubungkan ke database

header("Content-Type: application/json");

// Ambil data dari Midtrans
$data = file_get_contents('php://input');
$data_json = json_decode($data, TRUE);

// Simpan data transaksi ke database
$order_id = $data_json['order_id'];
$status_code = $data_json['transaction_status'];

// Query untuk mengupdate status transaksi di database
$update_order_sql = "UPDATE transaksi SET status = '$status_code' WHERE order_id = '$order_id'";
$result = mysqli_query($db, $update_order_sql);

if (!$result) {
    // Jika terjadi kesalahan dalam query, kirim respons ke Midtrans dengan status error
    echo json_encode(['status' => 'error']);
} else {
    // Jika query berhasil
    if ($status_code == 'pending') {
        // Jika status pembayaran adalah "pending", tambahkan status pembayaran "pending" ke dalam database
        $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'pending' WHERE order_id = '$order_id'";
        mysqli_query($db, $update_payment_status_sql);
        echo json_encode(['status' => 'pending']);
    } elseif ($status_code == 'expire') {
        // Jika status pembayaran adalah "expired", tambahkan status pembayaran "expired" ke dalam database
        $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'expired' WHERE order_id = '$order_id'";
        mysqli_query($db, $update_payment_status_sql);
        echo json_encode(['status' => 'expired']);
    } else {
        // Jika status pembayaran bukan "pending" atau "expired", tambahkan status pembayaran "success" ke dalam database
        $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'success' WHERE order_id = '$order_id'";
        mysqli_query($db, $update_payment_status_sql);
        echo json_encode(['status' => 'success']);
    }
}
// This is the notification handler endpoint that Midtrans will call

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set your server key
Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];




Midtrans\Config::$isProduction = false; // Set to true for the production environment
Midtrans\Config::$isSanitized = true;
Midtrans\Config::$is3ds = true;

// Create a notification object, it will automatically fetch the transaction data
$notif = new Midtrans\Notification();

try {
    $transactionStatus = $notif->transaction_status;
    $orderId = $notif->order_id;

    // You may want to retrieve the order from your database and check its current status to prevent race conditions
    $order_query = mysqli_query($db, "SELECT * FROM transaksi WHERE order_id = '$orderId'");
    $order_row = mysqli_fetch_assoc($order_query);

    if ($order_row) {
        // Order exists, perform actions based on transaction status
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            // If the transaction is settled or captured, update your database to mark it as paid
            $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'success', status = 'succes' WHERE order_id = '$orderId'";
            mysqli_query($db, $update_payment_status_sql);
        } elseif ($transactionStatus == 'pending') {
            // TODO: set payment status in the merchant's database to 'Pending'
            $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'Pending', status = 'Pending' WHERE order_id = '$orderId'";
            mysqli_query($db, $update_payment_status_sql);
        } elseif ($transactionStatus == 'deny') {
            // TODO: set payment status in the merchant's database to 'Denied'
            $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'Denied', status = 'Denied' WHERE order_id = '$orderId'";
            mysqli_query($db, $update_payment_status_sql);
        } elseif ($transactionStatus == 'expire') {
            // TODO: set payment status in the merchant's database to 'expire'
            $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'Expire', status = 'Expire' WHERE order_id = '$orderId'";
            mysqli_query($db, $update_payment_status_sql);
        } elseif ($transactionStatus == 'cancel') {
            // TODO: set payment status in the merchant's database to 'Canceled'
            $update_payment_status_sql = "UPDATE transaksi SET status_pembayaran = 'canceled', status = 'Cancel' WHERE order_id = '$orderId'";
            mysqli_query($db, $update_payment_status_sql);
        }

        // You can handle other transaction statuses similarly

        echo "Order payment status has been updated to: " . $transactionStatus;
    } else {
        // Order not found, log or handle accordingly
        echo "Order not found for order_id: " . $orderId;
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    exit();
}