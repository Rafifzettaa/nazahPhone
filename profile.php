<?php

include 'koneksi.php';
session_start();

$user_id = $_SESSION['id_user'];
function ambil_data($user_id, $db)
{
	$sql = "SELECT customer.*, alamat.* 
	FROM customer 
    JOIN alamat ON customer.id_alamat = alamat.id_alamat
    WHERE customer.id_user = $user_id";
	$query = mysqli_query($db, $sql);

	return mysqli_fetch_assoc($query);
}
?>
<!DOCTYPE html>
<html lang="id">


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulir Profil</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Bootstrap CSS -->
</head>

<body>
	<?php include 'navbar.php' ?>
	<div class="container mt-5">
		<div class="row mb-4">
			<div class="col-12">
				<div class="d-flex align-items-center">
					<i class="bi bi-person-circle" style="font-size: 2rem;"></i>
					<h2 class="ms-3">Profil Saya</h2>
				</div>
				<p>Kelola informasi profil anda guna melindungi dan mengamankan akun</p>
			</div>
		</div>
		<form method="POST" action="proses_profile.php">
			<div class="row">
				<!-- Informasi Pribadi -->
				<div class="col-md-4">
					<h3>Informasi Pribadi</h3>
                    <?php
                    $r = ambil_data($user_id, $db);
									// Proses hasil kueri

									?>
					<div class="mb-3">
						<label for="username" class="form-label">Nama Lengkap*</label>
						<input type="text" class="form-control" id="username" name="nama" >
					</div>

					<div class="mb-3">
						<label for="gender" class="form-label">Jenis Kelamin *</label>
						<select class="form-select" id="gender" name="jk" >
							<option value="">Pilih...</option>
							<option value="Laki-Laki" >Laki-Laki</option>
							<option value="Perempuan" >Perempuan</option>
						</select>
					</div>

				</div>
				<div class="col-md-4 mb-3 mt-5 align-self-xl-start">
					<div class="mb-3">
						<label for="birthdate" class="form-label">Tanggal Lahir *</label>
						<input type="date" class="form-control" id="birthdate" name="tanggal_lahir" >
					</div>
					<div class="mb-3">
						<label for="phone" class="form-label">No. Handphone *</label>
						<input type="text" class="form-control" id="phone" name="no_hp">
					</div>
				</div>
				<!-- Alamat Pribadi -->
				<div class="col">
					<h3>Alamat Pribadi</h3>

					<div class="mb-3">
						<label for="province" class="form-label" >Alamat *</label>
						<textarea class="form-control" name="alamat" id="" name="alamat"  ></textarea>
					</div>
					<div class="mb-3">
						<label for="city" class="form-label">Provinsi *</label>
						<input type="text" class="form-control" id="city" name="provinsi" >
					</div>
					<div class="mb-3">
						<label for="district" class="form-label">Kota/Kabupaten *</label>
						<input type="text" class="form-control" id="district" name="kota" >
					</div>
					<div class="mb-3">
						<label for="zipcode" class="form-label">Kode Pos *</label>
						<input type="text" class="form-control" id="zipcode" name="kode_pos" >
					</div>

				</div>
			</div>
			<div class="mb-3">
				<button type="submit" class="btn btn-primary" name="addProfile">Simpan Perubahan Profil</button>
			</div>
		</form>
		
		<?php
		
		if ($_SESSION['profile_incomplete'] === true) {
			// Jika data profil belum terisi, tampilkan pesan atau form pengisian profil
		?>

			<div class="mb-3">
				<button type="button" disabled class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfileModal">Update Profile</button>
			</div>
		<?php } else {
			// Jika data profil sudah terisi, tampilkan tombol Checkout
		?>
			<div class="mb-3">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfileModal">Update Profile</button>
			</div>
		<?php }

		?>

		<!-- Modals -->
		<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- Formulir Profil -->
						<form method="POST" action="proses_profile.php" id="updateForm">
							<div class="container mt-5">
								<div class="row">
									<?php
									$r = ambil_data($user_id, $db);
									// Proses hasil kueri

									?>
									<!-- Informasi Pribadi -->
									<div class="col-md-4">
										<h3>Informasi Pribadi</h3>
										<div class="mb-3">
											<label for="username" class="form-label">Nama Lengkap*</label>
											<input type="text" class="form-control" id="username" name="nama" value="<?php echo $r['nama'] ?>">
										</div>

										<div class="mb-3">
											<label for="gender" class="form-label">Jenis Kelamin *</label>
											<select class="form-select" id="gender" name="jk" required>
												<!-- Tambahkan value dan selected untuk jenis kelamin -->
												<option value="Laki-Laki" <?php echo ($r['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
												<option value="Perempuan" <?php echo ($r['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
											</select>
										</div>

									</div>
									<div class="col-md-4 mb-3 mt-5 align-self-xl-start">
										<div class="mb-3">
											<label for="birthdate" class="form-label">Tanggal Lahir *</label>
											<input type="date" class="form-control" id="birthdate" name="tanggal_lahir" value="<?php echo $r['tanggal_lahir'] ?>">
										</div>
										<div class="mb-3">
											<label for="phone" class="form-label">No. Handphone *</label>
											<input type="text" class="form-control" id="phone" name="no_hp" value="<?php echo $r['phone'] ?>">
										</div>
									</div>
									<!-- Alamat Pribadi -->
									<div class="col">
										<h3>Alamat Pribadi</h3>

										<div class="mb-3">
											<label for="province" class="form-label">Alamat *</label>
											<textarea class="form-control" name="alamat" id="alamat"><?php echo  $r['detail_alamat']; ?></textarea>
										</div>
										<div class="mb-3">
											<label for="city" class="form-label">Provinsi *</label>
											<input type="text" class="form-control" id="city" name="provinsi" value="<?php echo  $r['provinsi']; ?>">
										</div>
										<div class="mb-3">
											<label for="district" class="form-label">Kota/Kabupaten *</label>
											<input type="text" class="form-control" id="district" name="kota" value="<?php echo  $r['kota']; ?>">
										</div>
										<div class="mb-3">
											<label for="zipcode" class="form-label">Kode Pos *</label>
											<input type="text" class="form-control" id="zipcode" name="kode_pos" value="<?php echo  $r['kode_pos']; ?>">
										</div>

									</div>
								</div>

								<div class="mb-3">
									<button type="submit" class="btn btn-primary" name="updateProfile">Update Profile</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>

	<div class="container">
		<form action="proses_profile.php" method="post">
			<!-- Perubahan Kata Sandi -->
			<div class="row  ">
				<div class="col-md-6">
					<h3>Perubahan Kata Sandi</h3>
					<div class="mb-3">
						<label for="currentPassword" class="form-label">Kata Sandi Saat Ini (Biarkan Kosong Jika Tidak Ingin Diubah)</label>
						<input type="password" class="form-control" name="currentPassword" id="currentPassword">
					</div>
					<div class="mb-3">
						<label for="newPassword" class="form-label">Kata Sandi Baru *</label>
						<input type="password" class="form-control" id="newPassword" name="newPassword" required>
					</div>
				</div>

				<div class="col align-self-center text-end">
					<div class="mb-3">
						<button type="submit" class="btn btn-primary" name="ganti">Simpan Perubahan Kata Sandi</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- Tombol Simpan Perubahan -->


	</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script>
		// Wait for the DOM to be ready
		document.addEventListener("DOMContentLoaded", function() {
			// Initialize Bootstrap modal
			var myModal = new bootstrap.Modal(document.getElementById('updateProfileModal'));
		});
	</script>

</body>

</html>



<?php include 'footer.php'; ?>