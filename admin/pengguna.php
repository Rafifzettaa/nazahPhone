<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pengguna</title>
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
        <div class="text">Pengguna</div>
        
        <div class="container">
       
            <div class="panel">
                <div class="panel-handling">
                    <h4>Data Pelanggan</h4>
                </div>
                <div class="panel-body">
                    
                    <a href="pengguna_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>

                    <br>
                    <br>
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>No.Hp</th>
                                <th eidth="15%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "koneksi.php";
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM customer order by nama asc");
                            while ($d = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['jenis_kelamin']; ?></td>
                                    <td><?php echo $d['tanggal_lahir']; ?></td>
                                    <td><?php echo $d['phone']; ?></td>
                                    
                                    
                                    <td>
                                        <a href="pengguna_hapus.php?id=<?php echo $d['id_customer']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                                        <a href="pengguna_detail.php?id=<?php echo $d['id_customer']; ?>" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
    <script src="script.js"></script>
    <!-- Add any additional JavaScript scripts here if needed -->
</body>

</html>
