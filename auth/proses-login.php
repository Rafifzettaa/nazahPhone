<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
     // Admin authentication
     $sqlAdmin = "SELECT * FROM admin1 WHERE username ='$username' AND password ='$password'";
     $queryAdminLogin = mysqli_query($db, $sqlAdmin);
 
     if ($queryAdminLogin && mysqli_num_rows($queryAdminLogin) > 0) {
         $_SESSION['username'] = $username;
         $_SESSION['status'] = 'login';
         header('location: ../admin/index.php');
         exit();
     }
 
     // User authentication
     $query = "";
     if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
         $query = "SELECT * FROM user WHERE email='$username' AND password='$password'";
     } else {
         $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
     }
    
    
    
   
    
    
    // Eksekusi kueri
    $result = $db->query($query);

    // Proses hasil kueri
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Cek apakah data profil belum terisi
     

        // Sesuaikan sesi sesuai kebutuhan
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        $_SESSION['id_user'] = $row['id_user'];

        
        // Ambil jumlah produk di keranjang
        $queryCart = "SELECT COUNT(*) AS total_items FROM keranjang WHERE id_user = '{$_SESSION['id_user']}'";
        $resultCart = $db->query($queryCart);

        if ($resultCart->num_rows > 0) {
            $rowCart = $resultCart->fetch_assoc();
            $cart_count = $rowCart['total_items'];

            // Set nilai sesi cart_count hanya jika ada produk di keranjang
            if ($cart_count > 0) {
                $_SESSION['cart_count'] = $cart_count;
            }
        }
        $sql = "SELECT COUNT(*) AS total FROM customer c
        LEFT JOIN alamat a ON c.id_alamat = a.id_alamat
        WHERE c.id_user = '{$_SESSION['id_user']}' AND (c.nama IS NOT NULL AND a.detail_alamat IS NOT NULL)";

        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Directly check if the count is greater than 0
            if ($row['total'] > 0) {
                $_SESSION['profile_incomplete'] = false;
            }
            else{
                $_SESSION['profile_incomplete'] = true;
            }
        }

        $_SESSION['is_login'] = true;

        // Redirect ke halaman utama
        header("location: ../index.php");
        exit();
    } else {
        // Jika tidak sesuai keduanya, arahkan kembali ke halaman login
        header("location: ../login.php?pesan=gagal");
        exit();
    }
}

?>
