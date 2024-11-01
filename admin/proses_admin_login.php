<?php 
session_start();
include '../koneksi.php';




$username= $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM admin1 WHERE username ='$username' AND password ='$password'";
$queryLogin=mysqli_query($db,$sql);

if($queryLogin){
    // $_SESSION['status'] = 'login';
    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'login';
    header('location: index.php');
}
else {
    header('location:index.php?pesan=gagal');
}

?>