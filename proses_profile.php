<?php
include 'koneksi.php';

session_start();
$user_id = $_SESSION['id_user'];

function ambil_data($user_id, $db)
{
    $sql = "SELECT d.*, a.* FROM customer d
    JOIN alamat a ON d.id_alamat = a.id_alamat
    WHERE d.id_user = $user_id";
    $query = mysqli_query($db, $sql);
    return mysqli_fetch_assoc($query);
}

function update_data($db, $user_id, $username,$gender, $birthdate, $phone, $alamat, $provinsi, $kota, $zipcode, $id_alamat_pembayaran)
{
    // Lakukan update ke tabel alamat_pembayaran
    $sqlAlamatPembayaran = "UPDATE alamat
                            SET
                                detail_alamat = '$alamat',
                                kota = '$kota',
                                kode_pos = '$zipcode',
                                provinsi = '$provinsi',
                                no_hp='$phone'
                            WHERE id_alamat = $id_alamat_pembayaran";
    mysqli_query($db, $sqlAlamatPembayaran);

    // Lakukan update ke tabel data_customer
    $sqlDataCustomer = "UPDATE customer
                        SET 
                            nama = '$username',
                            jenis_kelamin = '$gender',
                            tanggal_lahir = '$birthdate',
                            phone = '$phone'
                        WHERE id_user = $user_id";

    return mysqli_query($db, $sqlDataCustomer);
}


function tambah_data($db, $username, $birthdate, $gender, $phone, $alamat, $kota, $provinsi, $zipcode, $user_id,$ciri,$disableCheckout)
{
    $disableCheckout = false;

    $user_id = $_SESSION['id_user'];
    // Lakukan insert ke tabel alamat_pembayaran
    $sqlAlamatPembayaran = "INSERT INTO alamat ( detail_alamat, provinsi, kota, kode_pos,no_hp)
                            VALUES ( '$alamat', '$provinsi', '$kota', '$zipcode','$phone')";
    mysqli_query($db, $sqlAlamatPembayaran);

    // Dapatkan ID alamat_pembayaran yang baru saja dimasukkan
    $idAlamatPembayaran = mysqli_insert_id($db);

    // Lakukan insert ke tabel data_customer dengan menyertakan ID alamat_pembayaran
    $sqlDataCustomer = "INSERT INTO customer ( nama,jenis_kelamin,tanggal_lahir,phone ,id_alamat, id_user )
                        VALUES ('$username','$gender', '$birthdate', '$phone', '$idAlamatPembayaran' ,'$user_id')";
    
    var_dump($sqlDataCustomer);
    $ciri=$_SESSION['profile_incomplete'] = false;

    return mysqli_query($db, $sqlDataCustomer);
}


function ganti_password($user_id, $db, $currentPassword, $newPassword)
{
    $hashedCurrentPassword = md5($currentPassword, PASSWORD_DEFAULT);
    $newPassword= md5($newPassword);
    $sql = "UPDATE user SET password = '$newPassword' WHERE id_user = $user_id";
    return mysqli_query($db, $sql);
}

function check_profile_completion($user_id, $db) {
    $sql = "SELECT COUNT(*) AS total FROM customer c
            LEFT JOIN alamat a ON c.id_alamat = a.id_alamat
            WHERE c.id_user = $user_id AND (c.nama IS NOT NULL AND a.detail_alamat IS NOT NULL)";
    
    $query = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($query);

    return $result['total'] > 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cek form mana yang disubmit berdasarkan nilai tombol submit
    if (isset($_POST['updateProfile'])) {
            $user_id = $_SESSION['id_user'];

        // Tangkap nilai-nilai dari formulir HTML
        $username = $_POST['nama'];
        
        $gender = $_POST['jk'];
        $birthdate = $_POST['tanggal_lahir'];
        $phone = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $zipcode = $_POST['kode_pos'];
        
        $id_alamat_pembayaran =mysqli_insert_id($db);
        // Panggil fungsi update_data untuk memperbarui profil
        $updateResult = update_data($db, $user_id, $username, $gender, $birthdate, $phone, $alamat, $provinsi, $kota, $zipcode, $id_alamat_pembayaran);

        if ($updateResult) {
            if (check_profile_completion($user_id, $db)) {
                $_SESSION['profile_incomplete'] = false;
            }
            // Redirect atau berikan respons sukses sesuai kebutuhan Anda
            header('Location: profile.php?status=success');
            exit();
        } else {
            // Redirect atau berikan respons gagal sesuai kebutuhan Anda
            header('Location: profile.php?status=failed');
            exit();
        }

        
    } elseif(isset($_POST['addProfile'])){
        $user_id = $_SESSION['id_user'];

        // Tangkap nilai-nilai dari formulir HTML
        $username = $_POST['nama'];
        $disableCheckout = false;
        
        $gender = $_POST['jk'];
        $birthdate = $_POST['tanggal_lahir'];
        $phone = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $zipcode = $_POST['kode_pos'];
        $addResult = tambah_data($db, $username, $birthdate,$gender, $phone, $alamat,  $kota, $provinsi, $zipcode,$user_id,$ciri,$disableCheckout);

        if ($addResult) {
            if (check_profile_completion($user_id, $db)) {
                $_SESSION['profile_incomplete'] = false;
            }
            header('Location: profile.php?status=success');
            exit();
        } else {
            // Redirect atau berikan respons gagal sesuai kebutuhan Anda
            header('Location: profile.php?status=failed');
            exit();
        }
    }
    elseif (isset($_POST['ganti'])) {
        // Tangkap nilai-nilai dari formulir HTML
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];

        // Panggil fungsi ganti_password untuk mengubah kata sandi
        $passwordResult = ganti_password($user_id, $db, $currentPassword, $newPassword);

        if ($passwordResult) {
            // Redirect atau berikan respons sukses sesuai kebutuhan Anda
            header('Location: profile.php?status=success');
            exit();
        } else {
            // Redirect atau berikan respons gagal sesuai kebutuhan Anda
            header('Location: profile.php?status=failed');
            exit();
        }
    }
}
?>
