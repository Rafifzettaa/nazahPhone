<?php 
session_start();
include 'koneksi.php';


// Connection to the database

// Query to fetch product data
// $sql = "SELECT * FROM produk where diskon >1 ";
// $result = $db->query($sql);


if (!$_SESSION["is_login"] === TRUE) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-light">
<?php include 'navbar.php';?>
    <div class="container">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h2 class="border-bottom pb-2 mb-0 text-center" >Tentang Kami</h2>
        </div>
                
        

<div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col-6">
                <div class="card h-100 align-items-center">
                <img src="assets/about_image/madan.jpg" class="card-img-top img-fluid " style="height: 300px;  width: 300px; object-fit: cover;" alt="...">
                <div class="card-body align-items-centers">
                    <h5 class="card-title">Ramadhan Adiansyah (Ketua)</h5>
                    <p class="card-text">2022310011</p>
                </div>
                </div>
                 </div> 

  <div class="col">
    <div class="card h-100 align-items-center">
      <img src="assets/about_image/jambrotun.jpg" class="card-img-top img-fluid " style="height: 300px;  width: 300px; object-fit: cover;" alt="...">
      <div class="card-body align-items-centers">
        <h5 class="card-title">Vina Zahrotun Nazah</h5>
        <p class="card-text">2022310040</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 align-items-center">
      <img src="assets/about_image/PUJA.jpg" class="card-img-top img-fluid " style="height: 300px;  width: 300px; object-fit: cover;" alt="...">
      <div class="card-body align-items-centers">
        <h5 class="card-title">Puja Vita Maharani</h5>
        <p class="card-text">2022310077</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 align-items-center">
      <img src="assets/about_image/jeta.jpg" class="card-img-top img-fluid " style="height: 300px;  width: 300px; object-fit: cover;" alt="...">
      <div class="card-body align-items-centers">
        <h5 class="card-title">Rafif Zetta Rajendra Pragiwoko</h5>
        <p class="card-text">2022310057</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 align-items-center">
      <img src="assets/about_image/jenal.jpg" class="card-img-top img-fluid " style="height: 300px;  width: 300px; object-fit: cover;" alt="...">
      <div class="card-body align-items-centers">
        <h5 class="card-title">Dhiya Rifqi Zain</h5>
        <p class="card-text">2022310011</p>
      </div>
    </div>
  </div>
  
</div>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>