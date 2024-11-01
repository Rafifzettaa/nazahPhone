<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login' || $_SESSION['username'] !== 'admin') {
    header("location: ../index.php?pesan=belum_login");
    exit();
}
?>
