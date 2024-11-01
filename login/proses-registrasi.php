<?php
include '../koneksi.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);

// Validasi input
if (empty($username) || empty($password) || empty($email)) {
    echo "<script>alert('Isi semua kolom!');</script>";
} else {
    // Periksa apakah username atau email sudah terdaftar sebelumnya
    $checkQuery = "SELECT * FROM user2 WHERE username = '$username' OR email = '$email'";
    $checkResult = mysqli_query($db, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('Username atau email sudah terdaftar. Gunakan yang lain');</script>";
        echo "<script>window.location.href = 'login.php';</script>";

    } else {
        if (strlen($password) < 8) {
            echo "<script>alert('Panjang password minimal 8 karakter!');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            // Query ke database untuk memeriksa keberadaan pengguna
            $query = "INSERT INTO user2 (username, email, password) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($db, $query);

            if ($result) {
                echo "<script>alert('Registrasi berhasil. Redirecting to login page.');</script>";
                echo "<script>window.location.href = 'login.php?status=berhasil_daftar';</script>";
                exit();
            } else {
                $error = "Registrasi gagal. Coba lagi.";
                echo "<script>alert('$error');</script>";
            }
        }
    }
}
?>
