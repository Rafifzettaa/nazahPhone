
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>
 <nav class="navbar navbar-expand-lg " style="background-color:#4682B4;">

<a class="navbar-brand text-left-panel" href="index.php">
    <img src="assets/NP.png" alt="" width="100" height="50">
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
            <a class="nav-link text-dark" href="about.php" tabindex="-1">Tentang Kami</a>
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
<a  class="text-decoration-none  text-white" href="riwayat_pembayaran.php" style="position: relative;"> 
<i class="bi bi-collection-fill me-1"></i>
</a>
    <a class="text-decoration-none" href="keranjang.php" style="position: relative;">
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
        <li><a href="logout.php" class="dropdown-item" type="button">Logout</a></li>
    </ul>
</div>
</nav>
