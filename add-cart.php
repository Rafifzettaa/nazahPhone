<?php
session_start();
include 'koneksi.php';

// Initialize the cart as an array if it doesn't exist
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if product_id and quantity are set in the POST request
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Ensure quantity is an integer
    $quantity = (int)$quantity;

    // Fetch product details from the database
    $product_sql = "SELECT nama_produk, gambar_a, deskripsi_produk, harga_produk FROM produk WHERE id_produk = $product_id";
    $product_result = mysqli_query($db, $product_sql);
    $product = mysqli_fetch_assoc($product_result);

    // Check if the product exists
    if ($product) {
        // Add the product details to the session cart
        if (isset($_SESSION['cart'][$product_id])) {
            // If the product is already in the cart, update the quantity
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            // If the product is not in the cart, add it with the specified quantity and details
            $_SESSION['cart'][$product_id] = array(
                'nama_produk' => $product['nama_produk'],
                'harga_produk' => $product['harga_produk'],
                'gambar' => $product['gambar_a'],
                'deskripsi_produk' => $product['deskripsi_produk'],
                'quantity' => $quantity
            );
        }
       $produk= $product['nama_produk'];
        // Insert or update the cart item in the database
        $user_id = $_SESSION['id_user']; // Assuming the user's ID is stored in the session
        // Check if the item already exists in the cart
        $check_sql = "SELECT kb.*, p.nama_produk
              FROM keranjang kb
              JOIN produk p ON kb.id_produk = p.id_produk
              WHERE kb.id_user = '$user_id' AND p.nama_produk = '$produk'";
        $check_result = mysqli_query($db, $check_sql);

        if ($row = mysqli_fetch_assoc($check_result)) {
            // Item exists, update the quantity
            $new_quantity = $row['jumlah_produk'] + $quantity;
            $update_sql = "UPDATE keranjang SET jumlah_produk = jumlah_produk + 1 WHERE id_user = $user_id AND id_produk = $product_id";
            mysqli_query($db, $update_sql);
        } else {
            
            // Item does not exist, insert a new record
           

            $insert_sql = "INSERT INTO keranjang (nama_produk,harga_produk,gambar,deskripsi_produk,jumlah_produk, id_produk,id_user) 
            VALUES (
                '". $product['nama_produk']. "',
                '". $product['harga_produk']. "',
                '". $product['gambar_a']. "',
                '". $product['deskripsi_produk']. "',
                $quantity,
                $product_id, 
                $user_id
            )";
            
            $_SESSION['cart_count'] += 1;
         mysqli_query($db, $insert_sql);
        }
    } else {
        // Product does not exist in the database
        // Handle error accordingly
        echo "Product does not exist.";
        exit;
    }
}

// Redirect back to the product page or to the cart page
header('Location: keranjang.php');
exit();
?>
