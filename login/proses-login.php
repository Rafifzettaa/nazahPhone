<?php
session_start();
include '../koneksi.php';

if(isset($_POST['login'])){
$username = $_POST['username'];
$password = md5($_POST['password']);

// Proses autentikasi
if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
    // Jika username adalah alamat email
    $query = "SELECT * FROM user1 WHERE email=? AND password=?";
} else {
    // Jika username adalah username biasa
    $query = "SELECT * FROM user1 WHERE username=? AND password=?";
}

// menggunakan prepared statement untuk mencegah SQL injection
$stmt = $db->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Proses hasil kueri
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if ($row['username'] == 'admin') {
        // Jika admin
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        $_SESSION['id_user'] = $row['id_user'];
        header("location: admin/index.php");
        exit();
    } else {
        // Jika user biasa
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        $_SESSION['id_user'] = $row['id_user'];;
        header("location:../home.php");
        exit();
    }
} else {
    // Jika tidak sesuai keduanya, arahkan kembali ke halaman login
    header("location: index.php?pesan=gagal");
    exit();
}

}
// Tutup statement
$stmt->close();
?>
