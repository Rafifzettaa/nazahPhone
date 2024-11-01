<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login' || $_SESSION['username'] !== 'admin') {
    header("location: ../index.php?pesan=belum_login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script>
        src = "assets/js/jquery.js"
    </script>
    <script src="assets/js/bootstrap.js"></script>
    
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home-section">
        <div class="text">Dashboard</div>
        <div class="container">
    <style>
        /* Custom Styles */
        .custom-section {
            background-color: #4682B4;
            padding: 20px;
        }

        .custom-section h1,
        .custom-section h4 {
            font-family: 'Poppins', sans-serif;
            color: aliceblue;
        }

        .custom-section p {
            margin-bottom: 20px;
            font-size: 15px;
        }

        .custom-section img {
            width: 300px;
        }
    </style>
    
<body>
    <section class="py-5 text-center custom-section container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-6" style="background-color: #4682B4">
                <h1 class="fw-light">Selamat Datang Admin NazahPhone</h1>
                <p class="lead text-body-secondary" style="color:aliceblue;">
                    Jangan ragu untuk menjelajahi fitur-fitur canggih yang kami sediakan untuk memastikan pengalaman pengguna yang optimal. Terima kasih atas dedikasi Anda dalam membuat NazahPhone menjadi tempat terbaik bagi para pecinta teknologi. Selamat bekerja
                </p>
            </div>
            <div class="col-lg-6 col-md-6">
                <img src="assets/picture.jpeg" alt="people">
            </div>
        </div>
    </section>

    <!-- ... -->

    <script>
        $(document).ready(function() {
            // Your DataTable initialization code
        });
    </script>
</body>

</html>




        </div>
    </section>
    <script src="script.js"></script>

</body>

</html>