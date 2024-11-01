<?php
include 'koneksi.php';


 
$username =$_POST['username'];
$email =$_POST['email'];
$password =md5($_POST['password']);
if(isset($_POST['registrasi'])){
 // Validasi input
 if (empty($username) || empty($password) || empty($email)) {
    $error = "Isi semua kolom!";
} else {
    // Periksa apakah username atau email sudah terdaftar sebelumnya
    $checkQuery = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    $checkResult = mysqli_query($db, $checkQuery);  

    if (mysqli_num_rows($checkResult) > 0) {
         echo "<script>";
         echo 'alert("Username atau email sudah terdaftar. Gunakan yang lain")';
         echo"</script>";
         header('location:../login.php?status=sudah_terdaftar');
    } else {
   
        // Query ke database untuk memeriksa keberadaan pengguna
        $query = "INSERT INTO user (username,email,password) VALUES
        ('$username', '$email','$password')";
        $result = mysqli_query($db, $query);

        if ($result) {
            header("location:../login.php?status=berhasil_daftar");
            exit();
        } else {
            $error = "Registrasi gagal. Coba lagi.";
        }
    }
}
}





?>
