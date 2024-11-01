<?php $base = $_SERVER['REQUEST_URI']; ?>
<?php


include 'koneksi.php';
session_start();
$user_id = $_SESSION['id_user'];

function ambil_data($user_id, $db)
{
    $sql = "SELECT 
    customer.nama,
    customer.phone,
    customer.jenis_kelamin,
    customer.tanggal_lahir,
    alamat.detail_alamat,
    alamat.kota,
    alamat.kode_pos,
    alamat.provinsi,
    user.email
    FROM customer
    JOIN user ON customer.id_user = user.id_user
    JOIN alamat ON customer.id_alamat = alamat.id_alamat
    WHERE customer.id_user = $user_id";
    $query = mysqli_query($db, $sql);
    return mysqli_fetch_assoc($query);
}
$n = ambil_data($user_id, $db);
// Fetch cart items
$keranjang_query = mysqli_query($db, "SELECT * FROM keranjang WHERE id_user = '$user_id'");
$cart_items = array();
while ($row = mysqli_fetch_assoc($keranjang_query)) {
    $cart_items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout Form | Integrasi midtrans di aplikasi payment sederhana - qadrlabs.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="mt-3">Checkout Form</h2>

        <form action="checkout-process.php" method="POST">
            <div class="mb-3">
                <label for="first_name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $n['nama'] ?>" readonly>
            </div>

            <!-- <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div> -->

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $n['email'] ?>"readonly>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $n['phone'] ?>"readonly>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="4"><?php echo $n['detail_alamat'] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $n['kota'] ?>"readonly>
            </div>

            <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code:</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo $n['kode_pos'] ?>"readonly>
            </div>

            <!-- <div class="mb-3">
            <label for="country_code" class="form-label">Country Code:</label>
            <input type="text" class="form-control" id="country_code" name="country_code" placeholder="isi IDN" required>
        </div> -->

            <!-- <div class="mb-3">
            <label for="alamat" class="form-label">Shipping Address:</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
        </div> -->

            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Payment Method:</label>
                <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="shopeepay">ShopeePay</option>
                    <option value="pembayaran">Semua Metode Pembayaran</option>
                    <option value="echannel">E-channel</option>
                    <option value="gopay">GOPAY</option>
                </select>
            </div>

            <button id="pay-button" type="submit" class="btn btn-success">Proses Pembayaran</button>
            <a class="btn btn-outline-secondary" href="keranjang.php">Kembali</a>

        </form>

    </div>

    <!-- Isi modal di sini -->




    <!-- Full screen modal -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>