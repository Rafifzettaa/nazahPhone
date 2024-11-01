<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	
</head>

<body>
	<?php include 'koneksi.php'; ?>

	<div class="container">
		<center>
			<h2>NazahPhone</h2>
			<img src="../assets/NP.png" alt="nazahphone" style="width: 130px; height: 100px; ">
		</center>
		<br /><br />

		<?php
		if (isset($_GET['dari']) && isset($_GET['sampai'])) {
			$dari = $_GET['dari'];
			$sampai = $_GET['sampai'];
		?>

			<h4>Data Transaksi NazahPhone <b><?php echo $dari; ?></b> sampai <b><?php echo $sampai; ?></b></h4>
			<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">No</th>
					<th>Order Id</th>
					<th>Nama Customer</th>
					<th>Tanggal Transaksi</th>
					<th>Nama Produk</th>
					<th>Brand</th>
					<!--<th>Jumlah (pcs)</th<-->
					<th>Total Harga</th>
				</tr>

				<?php
				//mengambil data pelanggan dari database
				$data = mysqli_query(
					$koneksi,
					" SELECT  
                                transaksi.order_id,
                                transaksi.tanggal_pesan,
                                transaksi.total_harga,
                                customer.nama,
                                produk.nama_produk,
                                produk.brand
                                FROM 
                                transaksi 
                                JOIN 
                                customer 
                                ON transaksi.id_user = customer.id_user
                                JOIN  
                                pemesanan 
                                ON transaksi.id_order = pemesanan.id_order
                                JOIN 
                                produk
                                ON pemesanan.id_produk = produk.id_produk
            

                                WHERE DATE(transaksi.tanggal_pesan) BETWEEN '$dari' AND '$sampai' 
                                ORDER BY transaksi.id_order DESC"
				);
				$no = 1;
				//mengbah data array ke data menampilkannya dengan perulangan while
				while ($d = mysqli_fetch_array($data)) {
				?>
					<tr>
						<td style="text-align: center;"><?php echo $no++ ?></td>
						<td style="text-align: center;"><?php echo $d['order_id']; ?></td>
						<td style="text-align: center;"><?php echo $d['nama']; ?></td>
						<td style="text-align: center;"><?php echo $d['tanggal_pesan']; ?></td>
						<td style="text-align: center;"><?php echo $d['nama_produk']; ?></td>
						<td style="text-align: center;"><?php echo $d['brand']; ?></td>
						<td style="text-align: center;"><?php echo "Rp." . number_format($d['total_harga']) . ",-"; ?></td>
				
					</tr>
				<?php } ?>
			</table>
	</div>
	</div>
<?php } ?>
</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>