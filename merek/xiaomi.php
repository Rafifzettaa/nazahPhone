<?php
include '../koneksi.php';
session_start();
// Connection to the database

// Query to fetch product data
$sql = "SELECT * FROM produk WHERE brand='Xiaomi'";
$result = $db->query($sql);






// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];

    // Query to fetch product data based on the search term
    $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$search%'";
    $result = $db->query($sql);
} else {
    // If no search term is provided or the form is not submitted, redirect to the home page
    // header("Location: index.php"); // Adjust the URL to your home page
    // exit();
}
// Close connection
$db->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" ></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

    <a class="navbar-brand text-left-panel" href="../index.php">
            <img src="../assets/NP.png" alt="" width="100" height="50">
        </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 bg-light">
                <li class="nav-item text-black text-lg-center">
                <a class="nav-link active text-dark" aria-current="page" href="../index.php">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Merek
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="xiaomi.php">Xiaomi</a></li>
                        <li><a class="dropdown-item" href="oppo.php">Oppo</a></li>
                        <li><a class="dropdown-item" href="iphone.php">Iphone</a></li>
                        <li><a class="dropdown-item" href="vivo.php">Vivo</a></li>
                        <li><a class="dropdown-item" href="samsung.php">Samsung</a></li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#" tabindex="-1">Tentang Kami</a>
                </li>
            </ul>
        </div>
        <div class="input-group w-25 pe-2 me-lg-5">

            <form action="search.php" method="get">


                <input type="text" class="w-75" name="search" id="search">
                <button type="submit">
                    <i class="bi bi-search"></i></button>
            </form>


        </div>

        <div class="text-end me-4">
            <a class="text-decoration-none" href="../keranjang.php" style="position: relative;">
                <i class="bi bi-cart3 me-1 text-white" style="font-size:25px"></i>
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php
                   echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : '0';

                  ?></span> </a>
        </div>
        <div class="dropdown-center">
            <button class="btn btn-secondary dropdown-toggle pe-3 me-2" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"><?php echo $_SESSION['username'] ?></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li><a href="profile.php" class="dropdown-item" type="button">Profile saya</a></li>
                <li><a href="#" class="dropdown-item" type="button">...</a></li>
                <li><a href="logout.php" class="dropdown-item" type="button">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- END NAVBAR -->



    <div class="container mt-3">
    <div class="d-flex justify-content-between">
            <h2 class="display-6">Xiaomi<i class="bi bi-phone"></i></h2>
            <p id="demo"></p>
        </div>
        <hr>
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <form action="add-to-cart.php" method="post">
                            <div class="col mb-5">
                                <div style=" background: white; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-top-left-radius: 35px; border-bottom-right-radius: 35px">
                                    <img src="../admin/image/<?= $row['gambar_a'] ?>" class="card-img-top" style="height: 298px; width: 260px; border-radius: 35px 0px 35px 0px; background: rgba(128, 128, 128, 0.10);" alt="...">
                                    <!-- Product image -->
                                    <div class="card-body">
                                        <div class="text-center" style="font-size: 26px; font-weight: 400;">
                                            <!-- Product name -->
                                            <h5 class="fw-bolder"><?= $row['nama_produk'] ?></h5>
                                           
                                            <!-- Product price -->
                                            <div class="text-center">
                                                <p class="card-text " style="font-size: 20px; font-weight: bold; color:red">Rp.<?= number_format($row['harga_produk']) ?></p>
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
                                        <a href="../detail1.php?id_produk=<?= $row['id_produk'] ?>" class="btn  btn-lg align-items-center w-75" style="border-radius: 20px; font-size: 13px; background:#4682B4;">Lihat Detail Produk</a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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