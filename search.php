<?php
include 'koneksi.php';
session_start();






$search = $_GET['search'];
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];

    // Query to fetch product data based on the search term
    $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$search%'";
    $result = $db->query($sql);
} else {
    // If no search term is provided or the form is not submitted, redirect to the home page
    header("Location: index.php"); // Adjust the URL to your home page
    exit();
}
// Close connection

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        #demo {
            font-family: 'Arial', sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: white;
            /* warna teks */
            background-color: #4682B4;
            /* warna latar belakang */
            padding: 10px;
            /* ruang dalam */
            border-radius: 5px;
            /* sudut bulat */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* bayangan */
        }

        .d-flex {
            display: flex;
            align-items: center;
        }

        h3 {
            margin: 0;
            /* hilangkan margin atas dan bawah */
        }
    </style>
</head>

<body class="">
    <!-- start Navbar -->
    <nav class="navbar navbar-expand-lg " style="background-color:#4682B4;">

    <a class="navbar-brand text-left-panel" href="index.php">
    <img src="assets/logo.jpg" alt="" width="100" height="50">
</a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 bg-light">
        <li class="nav-item text-black text-lg-center">
            <a class="nav-link active text-dark" aria-current="page" href="index.php">Beranda</a>
        </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Merek
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="merek/xiaomi.php">Xiaomi</a></li>
                <li><a class="dropdown-item" href="merek/oppo.php">Oppo</a></li>
                <li><a class="dropdown-item" href="merek/iphone.php">Iphone</a></li>
                <li><a class="dropdown-item" href="merek/vivo.php">Vivo</a></li>
                <li><a class="dropdown-item" href="merek/samsung.php">Samsung</a></li>
               
            </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" tabindex="-1">Tentang Kami</a>
                </li>
            </ul>
        </div>
        <div class="input-group w-25 pe-2 me-lg-5">

            <form action="" method="get">


                <input type="text" class="w-75" name="search" id="search">
                <button type="submit">
                    <i class="bi bi-search"></i></button>
            </form>


        </div>

        <div class="text-end me-4">
            <a class="text-decoration-none" href="keranjang.php" style="position: relative;">
                <i class="bi-cart-fill me-1 text-white" style="font-size:25px"></i>
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php
               echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0';

                  ?> <span class="visually-hidden">unread messages</span></span> </a>
        </div>
        <div class="dropdown-center">
    <button class="btn btn-secondary dropdown-toggle pe-3 me-2" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-person-circle"><?php echo $_SESSION['username'] ?></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <li><a href="profile.php" class="dropdown-item" type="button">Profile saya</a></li>
        <li><a href="logout.php" class="dropdown-item" type="button">Logout</a></li>
    </ul>
</div>
    </nav>
    <!-- END NAVBAR -->



    <div class="container mt-3">
        <div class="header align-items-center">
            <div style="width: 100%; height: 100%; position: relative">
                <div style="width: 1280px; height: 360px; left: 0px; top: 0px; position: relative; background: white; border: 2px;">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner " style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            <div class="carousel-item active">
                                <img src="assets/image/banner/banner_mi.jpeg" class="d-block " style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/image/banner/banner_samsung.png" class="d-block " alt="..." style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/image/banner/banner_vv.png" class="d-block " alt="..." style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/image/banner/banner_ip.jpeg" class="d-block w-100" alt="..." style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="brand-section col-12 py-lg-4 mt-3">
    <div class="bg-image card shadow-1-strong" style="width: 1287px; height: 300px; background-image: url('assets/rectangle.png');padding-left: 400px;padding-right: 10px;">
        <img src="assets/NP.png" class="w-50 m-3 " style="height:85%; " alt="">
    </div>
        </div>
        
        <hr>
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <form action="add-to-cart.php" method="post">
                            <div class="col mb-5">
                                <div style=" background: white; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);  border-bottom-right-radius: 35px">
                                    <img src="admin/image/<?= $row['gambar_a'] ?>" class="d-block img-fluid" style="height: 300px; width: 260px;  background: rgba(128, 128, 128, 0.10);" alt="...">
                                    <!-- Product image -->
                                    <div class="card-body">
                                        <div class="text-center" style="font-size: 26px; font-weight: 400;">
                                            <!-- Product name -->
                                            <h5 class="fw-bolder"><?= $row['nama_produk'] ?></h5>
                                            <?php
                                            $diskon = $row['harga_produk'] * $row['diskon'] / 100;
                                            $harga_setelah = $row['harga_produk'] - $diskon;
                                            ?>
                                            <!-- Product price -->
                                            <div class="d-flex">
                                                <p class="card-text px-2" style="font-size: 20px; font-weight: bold; color:red">Rp.<?= number_format($row['harga_produk']) ?></p>
                                            </div>
                                            <div class="align-content-center">
                                                <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400;"></p>
                                            </div>
                                            <div class="kelas">
                                                <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                                                <input type="hidden" name="produk" value="<?= $row['deskripsi_produk'] ?>">
                                                <input type="hidden" name="produk_nama" value="<?= $row['nama_produk'] ?>">
                                                <input type="hidden" name="produk_harga" value="<?= $harga_setelah ?>">
                                                <input type="hidden" name="produk_gam" value="<?= $row['gambar_a'] ?>">
                                            </div>
                                            <div class="align-items-center pb-2 ">
                                                <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400;"><?php echo $row['terjual'] ?> Terjual</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center pb-4 ">
                                        <a href="detail1.php?id_produk=<?= $row['id_produk'] ?>" class="btn  btn-lg align-items-center w-75" style="border-radius: 20px; font-size: 13px; background:#4682B4;">Lihat Detail Produk</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Tidak ada produk yang ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>



       
    </div>
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 my-2 py-1 border-top" style="background:#4682B4;">
    <div class="col mb-3 py-2">
      <a href="index.php" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
       <img src="assets/NP.png" width="150" height="100">
      </a>
      <p class="ms-5 text-dark"><i class="bi bi-geo-alt-fill fs-4"></i>Jl.Siliwangi No. 6 Rawa Panjang,</p>  <p class="ms-lg-5 text-dark">Kota Bekasi, 17115</p>
     
      <p class="ms-5 text-dark"><img src="assets/whatsapp.png" width="40" height="32"> Whatsapp 0812 1234 5678</p> 
    </div>

    <div class="col mb-3">
    
      
    </div>

    <div class="col mb-2">
      <h5>Tentang Kami</h5>
      <p class=" text-dark">Nazahphone adalah website penjualan handphone yang terbaik dengan menghadirkan harga yang sangat terjangkau</p>
      <br>
      <p class=" text-dark">Media Sosial</p>
      <p class="pe-2"><i class="bi bi-telegram fs-2"></i> <i class=" bi bi-instagram fs-2"></i></p>
    <p></p>
    </div>

    <div class="col mb-3">
      
    </div>

    <div class="col mb-3">
      <h5>Lokasi Kami</h5>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.029613220293!2d106.99192877503796!3d-6.259829593728733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698dce2ab0c19d%3A0x5705a69c5fd93556!2sUniversitas%20Bina%20Insani!5e0!3m2!1sid!2sid!4v1706250899932!5m2!1sid!2sid" width="400" height="300" style="border:0; padding-right:50%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </footer>
</body>
<script>
    // Mengatur waktu akhir perhitungan mundur
    var countDownDate = new Date("Jan 18, 2024 23:59:59").getTime();

    // Memperbarui hitungan mundur setiap 1 detik
    var x = setInterval(function() {

        // Untuk mendapatkan tanggal dan waktu hari ini
        var now = new Date().getTime();

        // Temukan jarak antara sekarang dan tanggal hitung mundur
        var distance = countDownDate - now;

        // Perhitungan waktu untuk hari, jam, menit dan detik
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Keluarkan hasil dalam elemen dengan id = "demo"
        document.getElementById("demo").innerHTML = hours + ":" +
            minutes + ":" + seconds;

        // Jika hitungan mundur selesai, tulis beberapa teks 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>

</html>