<?php
include 'koneksi.php';
session_start();
// Connection to the database

// Query to fetch product data



if (!$_SESSION["is_login"] === TRUE) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>NazahPhone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <style>
        
        body {
            font-family: "Montserrat", sans-serif;
        }

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

<body>
    <!-- start Navbar -->
    <?php include 'navbar.php' ?>

    <!-- END NAVBAR -->
    
    <?php
   
    if ($_SESSION['profile_incomplete'] === true) { ?>
        <div class="container d-flex align-items-center justify-content-center pt-1">
            <div class="toast bg-info text-dark fw-bolder" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    Hello,<?php echo $_SESSION['username']; ?>! Kamu Belum Mengisi Profile Beserta Alamat
                    Silahkan Isi Profile Terlebih Dahulu
                    <div class="mt-2 pt-2 border-top">
                        <a href="profile.php"  class="btn btn-success btn-sm text-dark">Klik Disini</a>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="container mt-3">
        <div class="header align-items-center">
            <div style="width: 100%; height: 100%; position: relative; border: 0px solid #4682B4;">
                <div style="width: 1280px; height: 360px; left: 0px; top: 0px; position: relative;  border: 2px solid #4682B4;">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner " style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            <div class="carousel-item active">
                                <img src="assets/image/banner/banner_ip.jpeg class="d-block img-fluid" style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/image/banner/banner_samsung.png" class="d-block img-fluid" alt="..." style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/image/banner/banner_vv.png" class="d-block img-fluid" alt="..." style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/image/banner/banner_ip.jpeg" class="d-block img-fluid" alt="..." style="width: 1275px; height: 355px; left: 0px; top: 0px; ">
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

        <div class="d-flex justify-content-between">
            <h3 class="display-6">Sedang Diskon <i class="bi bi-percent"></i></h3>
            <p id="demo"></p>
        </div>
        <!-- untuk diskon -->
        <?php
        $sql = "SELECT * FROM produk where diskon >1 ";
        $result = $db->query($sql);
        
        ?>
        <hr class="h-25" style="font-weight: bolder;">
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
                                                <p class="card-text px-2" style="font-size: 20px; font-weight: bold; color:red">Rp.<?= number_format($harga_setelah) ?></p>
                                                <p class="card-text me-1 " style="font-size: 18px; font-weight: 400; color:grey;"><s class="">Rp.<?php echo number_format($row['harga_produk']); ?></s></p>
                                            </div>
                                            <div class="align-content-center">
                                                <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400px;"></p>
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
        <h3>Smartphone Best Seller</h3>
        <hr>
        <!-- best seller -->
        <?php
        $sql = "SELECT * FROM produk WHERE terjual > 20 ORDER BY terjual DESC";

        $result = $db->query($sql);
        ?>


        <form action="add-to-cart.php" method="post">
            <div class="container">
                <div class="row gx-2 gx-lg-3 row-cols-3 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($prod = $result->fetch_assoc()) : ?>
                            <div class="col mb-5">
                                <div style=" background: white; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);  border-bottom-right-radius: 35px">

                                    <img src="admin/image/<?= $prod['gambar_a'] ?>" class="d-block img-fluid" style="height: 300px; width: 260px;  background: rgba(128, 128, 128, 0.10);" alt="...">

                                    <!-- Product image -->
                                    <div class="card-body">
                                        <div class="text-center" style="font-size: 26px; font-weight: 400;">
                                            <!-- Product name -->
                                            <h5 class="fw-bolder"><?= $prod['nama_produk'] ?></h5>
                                            <?php
                                            $diskon = $prod['harga_produk'] * 0.15;
                                            $harga_setelah = $prod['harga_produk'] - $diskon;
                                            ?>
                                            <!-- Product price -->
                                            <div class="d-flex">
                                                <p class="card-text px-2" style="font-size: 20px; font-weight: bold; color:red">Rp.<?= number_format($harga_setelah) ?></p>
                                                <p class="card-text me-1 " style="font-size: 18px; font-weight: 400; color:grey;"><s class="">Rp.<?php echo number_format($prod['harga_produk']); ?></s></p>
                                            </div>
                                            <div class="align-content-center">
                                                <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400;"></p>
                                            </div>
                                            <div class="kelas">
                                                <input type="hidden" name="id_produk" value="<?= $prod['id_produk'] ?>">
                                                <input type="hidden" name="produk" value="<?= $prod['deskripsi_produk'] ?>">
                                                <input type="hidden" name="produk_nama" value="<?= $prod['nama_produk'] ?>">
                                                <input type="hidden" name="produk_harga" value="<?= $harga_setelah ?>">
                                                <input type="hidden" name="produk_gam" value="<?= $prod['gambar_a'] ?>">
                                            </div>
                                            <div class="align-items-center pb-2 ">
                                                <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400px;"><?php echo $prod['terjual'] ?> Terjual</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center pb-4 ">
                                        <a href="detail1.php?id_produk=<?= $prod['id_produk'] ?>" class="btn  btn-lg align-items-center w-75" style="border-radius: 20px; font-size: 13px; background:#4682B4;">Lihat Detail Produk</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p>Tidak ada produk yang ditemukan.</p>
                    <?php endif; ?>
                </div>

                <h3>Smartphone Termurah</h3>
                <hr>
                <!-- harga Termurah -->
                <?php
                $sql = "SELECT * FROM produk WHERE harga_produk < 1500000 ORDER BY harga_produk ASC";
                $result = $db->query($sql);
                ?>

                <!-- Budget Smartphone Section -->

                <div class="container">
                    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                        <?php if ($result->num_rows > 0) : ?>
                            <?php while ($murah = $result->fetch_assoc()) : ?>
                                <div class="col mb-5">
                                    <div style=" background: white; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);  border-bottom-right-radius: 35px">

                                    <img src="admin/image/<?= $murah['gambar_a'] ?>" class="d-block img-fluid" style="height: 300px; width: 260px;  background: rgba(128, 128, 128, 0.10);" alt="...">

                                        <!-- Product image -->
                                        <div class="card-body">
                                            <div class="text-center" style="font-size: 26px; font-weight: 400;">
                                                <!-- Product name -->
                                                <h5 class="fw-bolder"><?= $murah['nama_produk'] ?></h5>
                                            
                                                <!-- Product price -->
                                                <div class="text-center">
                                                    <p class="card-text px-2" style="font-size: 20px; font-weight: bold; color:red">Rp.<?= number_format($murah['harga_produk']) ?></p>
                                                </div>
                                                <div class="align-content-center">
                                                    <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400;"></p>
                                                </div>
                                                <div class="kelas">
                                                    <input type="hidden" name="id_produk" value="<?= $murah['id_produk'] ?>">
                                                    <input type="hidden" name="produk" value="<?= $murah['deskripsi_produk'] ?>">
                                                    <input type="hidden" name="produk_nama" value="<?= $murah['nama_produk'] ?>">
                                                    <input type="hidden" name="produk_harga" value="<?= $harga_setelah ?>">
                                                    <input type="hidden" name="produk_gam" value="<?= $murah['gambar_a'] ?>">
                                                </div>
                                                <div class="align-items-center pb-2 ">
                                                    <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400;"><?php echo $murah['terjual'] ?> Terjual</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center pb-4 ">
                                            <a href="detail1.php?id_produk=<?= $murah['id_produk'] ?>" class="btn  btn-lg align-items-center w-75" style="border-radius: 20px; font-size: 13px; background:#4682B4;">Lihat Detail Produk</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>Tidak ada produk yang ditemukan.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <h3>Produk</h3>
                <hr>
                <!-- query untuk semua produk -->
                <?php
                $sql = "SELECT * FROM produk where diskon= 0 ";
                $result = $db->query($sql);
                ?>

                <div class="container">
                    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                        <?php if ($result->num_rows > 0) : ?>
                            <?php while ($murah = $result->fetch_assoc()) : ?>
                                <div class="col mb-5">
                                    <div style=" background: white; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);  border-bottom-right-radius: 35px">

                                    <img src="admin/image/<?= $murah['gambar_a'] ?>" class="d-block img-fluid" style="height: 300px; width: 260px;  background: rgba(128, 128, 128, 0.10);" alt="...">

                                        <!-- Product image -->
                                        <div class="card-body">
                                            <div class="text-center" style="font-size: 26px; font-weight: 400;">
                                                <!-- Product name -->
                                                <h5 class="fw-bolder"><?= $murah['nama_produk'] ?></h5>
                                                <?php
                                                $diskon = $murah['harga_produk'] * 0.15;
                                                $harga_setelah = $murah['harga_produk'] - $diskon;
                                                ?>
                                                <!-- Product price -->
                                                <div class="">
                                                    <p class="card-text text-center px-2" style="font-size: 20px; font-weight: bold; color:red">Rp.<?= number_format($murah['harga_produk']) ?></p>
                                                </div>
                                                <div class="align-content-center">
                                                    <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400;"></p>
                                                </div>
                                                <div class="kelas">
                                                    <input type="hidden" name="id_produk" value="<?= $murah['id_produk'] ?>">
                                                    <input type="hidden" name="produk" value="<?= $murah['deskripsi_produk'] ?>">
                                                    <input type="hidden" name="produk_nama" value="<?= $murah['nama_produk'] ?>">
                                                    <input type="hidden" name="produk_harga" value="<?= $harga_setelah ?>">
                                                    <input type="hidden" name="produk_gam" value="<?= $murah['gambar_a'] ?>">
                                                </div>
                                                <div class="align-items-center pb-2 ">
                                                    <p class="card-text align-content-center" style="font-size: 14px; font-weight: 400;"><?php echo $murah['terjual'] ?> Terjual</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center pb-4 ">
                                            <a href="detail1.php?id_produk=<?= $murah['id_produk'] ?>" class="btn  btn-lg align-items-center w-75" style="border-radius: 20px; font-size: 13px; background:#4682B4;">Lihat Detail Produk</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>Tidak ada produk yang ditemukan.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
    </div>
    </div>


  
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl);
        });

        toastList.forEach(function(toast) {
            toast.show();
        });

        // Mengatur waktu akhir perhitungan mundur
        var countDownDate = new Date("Jan 30, 2024 23:59:59").getTime();

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
            document.getElementById("demo").innerHTML = days + "D:" + hours + ":" +
                minutes + ":" + seconds;

            // Jika hitungan mundur selesai, tulis beberapa teks 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
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

</html>