<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rvAfo6VAeGSVA5qK3srXHqJT0Vg0jBrA/yuRj16uK4LlYYIEiVpgGpQ6DdGOnQOp" crossorigin="anonymous">
</head>

<body class="bg-light d-flex align-items-center">
    <?php
    session_start();
    include '../koneksi.php';

    // Fetch the transaction details with user information
    $id = $_GET['id_transaksi'];
    $query = "SELECT t.*, c.nama, c.phone, a.detail_alamat
          FROM transaksi t
          JOIN customer c ON t.id_user = c.id_user
          JOIN alamat a ON c.id_alamat = a.id_alamat
          WHERE t.id_order = $id";
    $result = mysqli_query($db, $query);

    if ($_SESSION['status'] != "login") {
        header("location:admin_login.php?pesan=belum_login");
    }
    if ($result && $t = mysqli_fetch_assoc($result)) {
    ?>
        <div class="container">
            <div class="card">
                <div class="card-header bg-black"></div>
                <div class="card-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <i class="far fa-building text-danger fa-6x float-start"></i>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 bord">
                                <div class="list-unstyled float-center">
                                    <h2 style="font-size: 40px;  "><b>NazahPhone</b></h2>
                                    <br>
                                    <a href="cetak_invoice.php?id_transaksi=<?php echo $id; ?>">CETAK</a>
                                </div>
                                <ul class="list-unstyled">
                                    <li>Nama Pembeli: <?php echo $t['nama']; ?></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>No HandPhone : <?php echo $t['phone']; ?></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>alamat : <?php echo $t['alamat_pengiriman']; ?></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>Status Pembayaran : <?php echo $t['status']; ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row text-center">
                            <h3 class="text-uppercase text-center mt-3">Invoice</h3>
                            <p><?php echo $t['order_id']; ?></p>
                        </div>

                        <div class="row mx-3">
                            <table class="table table-responsive table-bordered-stripe">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah Beli</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //koneksi database
                                    include 'koneksi.php';
                                    $sql = "SELECT t.*, c.nama AS nama_customer, 
                                    p.id_produk,
                                    produk.nama_produk,
                                    produk.harga_produk,
                                    p.jumlah_produk
                                    FROM transaksi t
                                    INNER JOIN customer c ON t.id_user = c.id_user
                                    INNER JOIN pemesanan p ON t.id_order = p.id_order
                                    INNER JOIN produk ON p.id_produk = produk.id_produk";
                                $queryData = mysqli_query($koneksi, $sql);

                                    

                                    $no = 1;
                                  while( $d = mysqli_fetch_assoc($queryData)){
                                        ?>
                                        <tr>
                                            <td><?php echo $d['nama_produk']; ?></td>
                                            <td><?php echo $d['jumlah_produk']; ?></td>
                                            <td><?php echo "Rp. " . number_format($d['harga_produk']) . " ,-"; ?></td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-xl-8">
                                <ul class="list-unstyled float-end me-0">
                                    <li><span class="me-3 float-start">Total Pembayaran :</span>
                                        <?php echo "Rp. " . number_format($t['total_harga']) . " ,-"; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <hr>

                    </div>

                    <div class="row mt-2 mb-5">
                        <p class="fw-bold">Tanggal Pesan: <span class="text-muted">
                            
                        <?php echo $t['tanggal_pesan']; ?></span></p>
                    </div>

                </div>
                <div class="card-footer bg-black"></div>
            </div>
        </div>

    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>