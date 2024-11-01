<?php
session_start();
require_once('../tcpdf/tcpdf.php');
include '../koneksi.php';

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
    // Konten HTML
    ob_start();
    include 'invoice_template.php';
    $htmlContent = ob_get_clean();

    // Buat objek TCPDF
    $pdf = new TCPDF();

    // Set judul dokumen
    $pdf->SetTitle('Invoice Transaksi');

    // Tambahkan halaman
    $pdf->AddPage();

    // Tambahkan isi ke dalam dokumen PDF
    $pdf->writeHTML($htmlContent, true, false, true, false, '');

    // Simpan PDF atau tampilkan dalam browser
    $pdf->Output($t['order_id'] . "_invoice.pdf", 'D');
}
?>
