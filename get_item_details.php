<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_items = json_decode($_POST['selected_items']);
   $jumlah = $_POST['jumlah_prouk'];
    $item_details = array();
    foreach ($selected_items as $selected_item) {
        $query = "SELECT id_produk, nama_produk, harga_produk ,jumlah_produk FROM produk WHERE id_produk = $selected_item";
        $result = mysqli_query($db, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            $item_detail = array(
                'id' => $row['id_produk'],
                'price' => $row['harga_produk'],
                'quantity' =>$row['jumlah_produk'] , // Sesuaikan dengan kebutuhan Anda
                'name' => $row['nama_produk']
            );

            $item_details[] = $item_detail;
        } else {
            // Handle kesalahan query jika diperlukan
            echo 'Error retrieving item details: ' . mysqli_error($db);
            exit();
        }
    }

    echo json_encode($item_details);
} else {
    // Tangani jika bukan metode POST
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request method';
    exit();
}
?>
