<?php 
session_start();
include 'navbar.php' ?>
<?php include 'koneksi.php'; ?>

<?php
// Get the product ID from the URL or from a session variable
$product_id = $_SESSION['id_user']; // or use $_SESSION or another method to get the product ID
if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Fetch the product details from the database
    $sql = "SELECT * FROM produk WHERE id_produk = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id_produk);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);
    // Check if the product was found
    if ($product) {
        // Use $product['nama_produk'], $product['harga_produk'], etc. in your HTML
    } else {
        echo "Product not found.";
    }
} else {
    echo "No product ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['nama_produk']?></title>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <!-- Carousel for product images -->
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="admin/image/<?php echo $product['gambar_a']; ?>" class="d-block w-75" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="admin/image/<?php echo $product['gambar_b']; ?>" class="d-block w-75" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="admin/image/<?php echo $product['gambar_c']; ?>" class="d-block w-75" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Thumbnail images -->
                <div class="row mt-3 gx-1">
                    <div class="col">
                        <img src="admin/image/<?php echo $product['gambar_a']; ?>" class="img-fluid img-thumbnail" alt="Thumbnail 1" onclick="toCarouselSlide(0)">
                    </div>
                    <div class="col">
                    <img src="admin/image/<?php echo $product['gambar_b']; ?>" class="img-fluid img-thumbnail" alt="Thumbnail 2" onclick="toCarouselSlide(1)">
                    </div>
                    <div class="col">
                    <img src="admin/image/<?php echo $product['gambar_c']; ?>" class="img-fluid img-thumbnail" alt="Thumbnail 3" onclick="toCarouselSlide(2)">
                    </div>
                </div>
            </div>
            <!-- Product details column -->
            <div class="col-md-6">
                <h2 class="mb-3"><?php echo $product['nama_produk']; ?></h2>
                <h3 class="mb-3">Rp.<?php echo number_format($product['harga_produk']); ?></h3>
                <!-- Product specifications -->
                <p><strong>Spesifikasi:</strong></p>
                <ul>
                    <li>Merek: <?php echo $product['brand'];?></li>
                    <li>Kapasitas Penyimpanan:<?php echo $product['k_penyimpanan'];?></li>
                    <li>Masa Garansi: 3 Bulan</li>
                    <li>Jenis Garansi: Garansi Toko</li>
                    <li>Stok: <?php echo $product['stok']; ?></li>
                    <li>Dikirim Dari: Kota Bekasi</li>
                </ul>
                <!-- Color selection -->
                
                <!-- Quantity and purchase -->
                <!-- Quantity and purchase -->
                <div class="d-flex mb-3">
                    <button class="btn btn-minus" onclick="decreaseCount(event, '<?php echo $row['id_produk']; ?>')">-</button>
                    <input type="number" name="quantity" class="form-control me-0" style="width: 10%;" value="1" id="quantityInput">
                    <button class="btn btn-plus me-2" onclick="increaseCount(event, '<?php echo $row['id_produk']; ?>')">+</button>
                    <!-- Tombol Tambah ke Keranjang -->
                    <form action="add-cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id_produk']; ?>">
                        <input type="hidden" name="nama_produk" value="<?php echo $product['nama_produk']; ?>">
                        <input type="hidden" name="deskripsi" value="<?php echo $product['deskripsi_produk']; ?>">
                        <input type="hidden" name="harga_produk" value="<?php echo $product['harga_produk']; ?>">
                        <input type="hidden" name="gambar" value="<?php echo $product['gambar_a']; ?>">
                        <input type="hidden" name="quantity" id="quantityHidden" value="1">
                        <button type="submit" class="btn btn-warning me-2">Tambah ke Keranjang</button>
                    </form>
                    <!-- Tombol Beli Sekarang -->
                    <form action="checkout-now.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id_produk']; ?>">
                        <input type="hidden" name="nama_produk" value="<?php echo $product['nama_produk']; ?>">
                        <input type="hidden" name="deskripsi" value="<?php echo $product['deskripsi_produk']; ?>">
                        <input type="hidden" name="harga_produk" value="<?php echo $product['harga_produk']; ?>">
                        <input type="hidden" name="gambar" value="<?php echo $product['gambar_a']; ?>">
                        <input type="hidden" name="quantity" id="quantityHidden" value="1">
                    <button class="btn btn-success" type="submit" onclick="buyNow('<?php echo $row['id_produk']; ?>')">Beli Sekarang</button>
                    </form>
                </div>

            </div>
        </div>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-6">
                    <!-- Product details go here -->
                    <p><strong>Deskripsi Produk :</strong></p>
                    <table class="table">
    <tr>
        <th scope="row">Nama Produk</th>
        <td>:</td>
        <td><?php echo $product['nama_produk'] ?></td>
    </tr>
    <tr>
        <th scope="row">Processor yang di gunakan</th>
        <td>:</td>
        <td><?php echo $product['tipe_processor'] ?></td>
    </tr>
    <tr>
        <th scope="row">RAM</th>
        <td>:</td>
        <td><?php echo $product['ram'] ?> GB</td>
    </tr>
    <tr>
        <th scope="row">Penyimpanan HandPhone</th>
        <td>:</td>
        <td><?php echo $product['k_penyimpanan'] ?> GB</td>
    </tr>
    <tr>
        <th scope="row">Kapasitas Baterai</th>
        <td>:</td>
        <td><?php echo $product['k_baterai'] ?> MAh</td>
    </tr>
    <tr>
        <th scope="row">Resolusi Kamera</th>
        <td>:</td>
        <td><?php echo $product['resolusi_kamera'] ?></td>
    </tr>
    <tr>
        <th scope="row">Ukuran Layar</th>
        <td>:</td>
        <td><?php echo $product['ukuran_layar'] ?> Inchi</td>
    </tr>
    <tr>
        <th scope="row">Fitur Handphone</th>
        <td>:</td>
        <td><?php echo $product['fitur_handphone'] ?></td>
    </tr>
    <tr>
        <th scope="row">Detail Spesifikasi</th>
        <td>:</td>
        <td><?php echo $product['deskripsi_produk'] ?></td>
    </tr>
</table>

                    
                   
                </div>
            </div>
        </div>
    </div>
    <!--INI FOOTER -->
    <?php include 'footer.php' ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   

    <script>
    function toCarouselSlide(index) {
        var carousel = new bootstrap.Carousel(document.querySelector('#carouselExampleIndicators'));
        carousel.to(index);
    }

    document.getElementById('quantityInput').addEventListener('change', function() {
        document.getElementById('quantityHidden').value = this.value;
    });

    $('.btn-plus').click(function() {
        var quantityInput = $('#quantityInput');
        var quantity = parseInt(quantityInput.val());
        quantity++;
        quantityInput.val(quantity);
        document.getElementById('quantityHidden').value = quantity;
    });

    $('.btn-minus').click(function() {
        var quantityInput = $('#quantityInput');
        var quantity = parseInt(quantityInput.val());
        if (quantity > 1) {
            quantity--;
            quantityInput.val(quantity);
            document.getElementById('quantityHidden').value = quantity;
        }
    });

    function increaseCount(event, id) {
        event.preventDefault();
        var input = document.getElementById('qty' + id);

        if (input) {
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;

        } else {
            console.error('Input element not found');
        }
    }

    function decreaseCount(event, id) {
        event.preventDefault();
        var input = document.getElementById('qty' + id);

        if (input) {
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value = Math.max(1, value - 1);
            input.value = value;

        } else {
            console.error('Input element not found');
        }
    }
</script>


    <!-- Bootstrap Bundle with Popper -->

</body>

</html>