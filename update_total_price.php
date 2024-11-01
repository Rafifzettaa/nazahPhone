<?php
session_start();
if (isset($_POST['total_harga'])) {
    $_SESSION['total_harga'] = $_POST['total_harga'];
}
?>
