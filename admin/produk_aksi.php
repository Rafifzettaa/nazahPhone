<?php
// Assuming you have a database connection
include '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Product Information
    $nama_produk = $_POST["nama_produk"];
    $deskripsi_produk = $_POST["deskripsi_produk"];
     $harga_produk = $_POST["harga_produk"];

    // Images
    $gambar_produk1 = $_FILES["foto1"]["name"];
    $gambar_produk2 = $_FILES["foto2"]["name"];
    $gambar_produk3 = $_FILES["foto3"]["name"];
    
    $target_dir = "image/"; // Ganti dengan direktori yang sesuai
    move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_dir . $gambar_produk1);
    move_uploaded_file($_FILES["foto2"]["tmp_name"], $target_dir . $gambar_produk2);
    move_uploaded_file($_FILES["foto3"]["tmp_name"], $target_dir . $gambar_produk3);

    // Stock and Brand Information
    $stok = $_POST["stok"];
    $merek = $_POST["brand"];
     // Spesifikasi Information
     $ukuran_layar = $_POST["ukuran_layar"];
     $resolusi_kamera = $_POST["resolusi_kamera"];
     $k_penyimpanan = $_POST["k_penyimpanan"];
     $ram = $_POST["ram"];
     $fitur_handphone = $_POST["fitur_handphone"];
     $tipe_processor = $_POST["tipe_processor"];
     $k_baterai = $_POST["k_baterai"];
 // Diskon
    $diskon = $_POST["diskon"];

    // Insert into the 'produk' table
    $query_produk = "INSERT INTO produk (nama_produk, gambar_a, gambar_b, gambar_c,deskripsi_produk,harga_produk,brand,stok,terjual,
    ukuran_layar, resolusi_kamera, k_penyimpanan, ram, fitur_handphone, tipe_processor, k_baterai,diskon) 
                     VALUES ('$nama_produk', '$gambar_produk1', '$gambar_produk2', '$gambar_produk3','$deskripsi_produk', '$harga_produk',
                     '$merek','$stok',0,'$ukuran_layar', '$resolusi_kamera', '$k_penyimpanan', '$ram', '$fitur_handphone', '$tipe_processor', '$k_baterai',0 )";

    // Execute the query_produk
    $query= mysqli_query($db,$query_produk);

    // Assuming 'id_produk' is auto-incremented, you can retrieve the last inserted ID
   

   
    
    // Close the database connection
    
}

header("Location: produk.php"); // Redirect to the product listing page
?>
