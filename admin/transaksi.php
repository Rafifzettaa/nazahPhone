<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nazahfone</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <section class="home-section">
        <div class="text">Transaksi</div>
        <div class="container">
       
            <div class="panel">
                <div class="panel-heading">
                    <h4>Data Transaksi Pengguna</h4>
                </div>
                <div class="panel-body">
                    <br />
                    <br />
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th width="1%">NO</th>
                                <th>Order ID</th>
                                <th>Nama Customer</th>
                                <th>Alamat Pengiriman</th>
                                <th>Tanggal Pesan</th>
                                <th>Total Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Status Pembayaran</th>
                                <th width="20%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //koneksi database
                            include 'koneksi.php';

                            $sql = "SELECT transaksi.*, customer.nama AS nama_customer
                            FROM transaksi
                            INNER JOIN customer ON transaksi.id_user = customer.id_user";

                            $queryData = mysqli_query($koneksi, $sql);
                            
                            $no = 1;
                            while ($d = mysqli_fetch_assoc($queryData)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['order_id']; ?></td>
                                    <td><?php echo $d['nama_customer']?></td>
                                    <td><?php echo $d['alamat_pengiriman']; ?></td>
                                    <td><?php echo $d['tanggal_pesan']; ?></td>
                                    <td><?php echo "Rp. " . number_format($d['total_harga']) . " ,-"; ?></td>
                                    <td><?php echo $d['metode_pembayaran']; ?></td>
                                    <td><?php echo $d['status']; ?></td>
                                    <td><?php echo $d['status_pembayaran']; ?></td>
                                    <td>
                                        <a href="transaksi_invoice.php?id_transaksi=<?php echo $d['id_order']; ?>" target="_blank" class="btn btn-sm btn-warning">Invoice</a>
                                        <a href="transaksi_edit.php?id_transaksi=<?php echo $d['id_order']; ?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="transaksi_hapus.php?id_transaksi=<?php echo $d['id_order']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
    <script src="script.js"></script>
</body>
</html>
