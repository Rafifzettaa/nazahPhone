<?php
function tanggal_indo($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 => 'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $split = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

// Contoh penggunaan
$tanggal_mysql = '2022-02-15';
$tanggal_indo = tanggal_indo($tanggal_mysql, true);

echo 'Tanggal MySQL: ' . $tanggal_mysql . '<br>';
echo 'Tanggal Indonesia: ' . $tanggal_indo;
?>
