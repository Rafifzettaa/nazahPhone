<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data pengguna</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<?php include 'sidebar.php'; ?>
<?php include 'koneksi.php'; ?>
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit Transaksi</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
                <br /><br />
                <?php
               if (isset($_GET['id_transaksi'])) {
                $id = $_GET['id_transaksi'];
        
                $sql = "SELECT transaksi.*, customer.nama AS customer_nama
                FROM transaksi
                INNER JOIN customer ON transaksi.id_user = customer.id_user
                WHERE transaksi.id_order = $id";
        
                $result = $koneksi->query($sql);
                // Check if there is a result
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                } else {
                    echo "No results found for ID: $id";
                    exit();
                }
            } else {
                echo "ID not provided in the URL";
                exit();
            }

                ?>
                    <form method="post" action="update-transaksi.php">
                        <!-- menyimpan id transaksi yang diedit dalam form hidden berikut -->
                        <input type="hidden" name="id_order" value="<?php echo $row['id_order']; ?>">

                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama anda" value="<?php echo $row['customer_nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat Pengiriman</label>
                            <input type="text" class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat anda" value="<?php echo $row['alamat_pengiriman']; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Tanggal Pesan</label>
                            <input type="text" class="form-control" name="tanggal_pesan" placeholder="Masukkan tanggal pesan" value="<?php echo $row['tanggal_pesan']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Total harga</label>
                            <input type="text" class="form-control" name="total_harga" placeholder="Masukan total harga" value="<?php echo $row['total_harga']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <input type="text" class="form-control" name="metode_pembayaran" placeholder="Masukan total pembayaran" value="<?php echo $row['metode_pembayaran']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" name="status" placeholder="Masukan status" value="<?php echo $row['status']; ?>">
                        </div>
                          </table>

                        <div class="form-group alert alert-info">
                            <label>Status Pembayaran</label>
                            <select class="form-control" name="status_pembayaran" required="required">
                               <option value="" selected>--PILIH--</option>
                               <option <?php if ($row['status_pembayaran'] == "0") {
                                            echo "selected='selected'";
                                        } ?> value="denied">denied</option>

                                <option <?php if ($row['status_pembayaran'] == "1") {
                                            echo "selected='selected'";
                                        } ?> value="pending">Pending</option>

                                <option <?php if ($row['status_pembayaran'] == "2") {
                                            echo "selected='selected'";
                                        } ?> value="success">success</option>

                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </form>
                <?php  ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>