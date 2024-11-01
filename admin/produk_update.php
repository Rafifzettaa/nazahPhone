<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Product Information
    $id = $_POST['id_produk'];
    $nama_produk = $_POST["nama_produk"];
    $brand_produk = $_POST["brand"];
    $harga_produk = $_POST["harga"];
    $deskripsi_produk = $_POST["deskripsi_produk"];

    // Images
    $gambar_produk1 = $_FILES["foto1"]["name"];
    $gambar_produk2 = $_FILES["foto2"]["name"];
    $gambar_produk3 = $_FILES["foto3"]["name"];

    // Pindahkan file-file gambar ke direktori yang diinginkan
    $target_dir = "image/"; // Ganti dengan direktori yang sesuai
    move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_dir . $gambar_produk1);
    move_uploaded_file($_FILES["foto2"]["tmp_name"], $target_dir . $gambar_produk2);
    move_uploaded_file($_FILES["foto3"]["tmp_name"], $target_dir . $gambar_produk3);

    // Stock and Brand Information
    $stok = $_POST["stok"];

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

    // Lakukan proses update ke database
    $query = "UPDATE produk
              SET 
              nama_produk = '$nama_produk',
              brand = '$brand_produk',
              harga_produk = '$harga_produk',
              stok = '$stok',
              deskripsi_produk ='$deskripsi_produk',
              ukuran_layar ='$ukuran_layar',
              resolusi_kamera ='$resolusi_kamera',
              k_penyimpanan ='$k_penyimpanan',
              ram ='$ram',
              fitur_handphone ='$fitur_handphone',
              tipe_processor ='$tipe_processor',
              k_baterai ='$k_baterai',
              diskon = '$diskon'";

    // Check if any image is being updated
    if (!empty($gambar_produk1) || !empty($gambar_produk2) || !empty($gambar_produk3)) {
        // If at least one image is being updated
        $query .= ", gambar_a='$gambar_produk1', gambar_b='$gambar_produk2', gambar_c='$gambar_produk3'";
    }

    $query .= " WHERE id_produk = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Data produk berhasil diupdate.";
        header("Location: produk.php"); // Redirect ke halaman produk.php
        exit();
    } else {
        echo "Gagal mengupdate data produk: " . mysqli_error($koneksi);
    }
}
?>
