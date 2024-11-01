-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 26 Jan 2024 pada 05.22
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nazah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin1`
--

CREATE TABLE `admin1` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin1`
--

INSERT INTO `admin1` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` int(11) NOT NULL,
  `detail_alamat` text NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `detail_alamat`, `provinsi`, `kota`, `kode_pos`, `no_hp`) VALUES
(3, 'Jl.melati 2 Perumahan Mega Regency Blok G9 No 17 RT01 RW 20', 'Jawa Tengah', 'Kota Tegal', '17330', '0812314151'),
(4, 'Jakarta Selatan', 'Jawa Barat', 'Kab. Bekasi', '17330', '0895123141'),
(5, 'aDdad', 'Jawa Barat', 'Kab Bekasi', '17330', '081514124421'),
(6, 'DDA', 'Jawa Barat', 'Kab Bekasi', '17330', '0812314151'),
(7, 'mega regency', 'Jawa Tengah', 'Kab Bekasi', '17330', '0895123141'),
(8, 'gaga', 'Jawa Tengah', 'Kab Bekasi', '17330', '0015111111'),
(9, 'adada', 'Jawa Barat', 'Kab Bekasi', '17330', '0015111111'),
(10, 'adaad', 'Jawa Tengah', 'Kab Bekasi', '17330', '0812314151'),
(11, 'aafafa', 'Jawa Tengah', 'Kab Bekasi', '17330', '0895123141'),
(12, 'acaa', 'Jawa Barat', 'Kab Bekasi', '17330', '0015111111'),
(13, 'adafa', 'Jawa Barat', 'Kab Bekasi', '17330', '0812314151');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_alamat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `phone`, `id_user`, `id_alamat`) VALUES
(3, 'zaipr', 'Laki-Laki', '2000-01-04', '0812314151', 6, 3),
(12, 'rafiff', 'Laki-Laki', '2021-10-05', '0015111111', 8, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` decimal(10,2) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `nama_produk`, `harga_produk`, `gambar`, `deskripsi_produk`, `jumlah_produk`, `id_produk`, `id_user`) VALUES
(30, 'Apple iPhone 13 128GB', '2500000.00', 'depan.jpeg', 'adadada', 2, 3, 9),
(31, 'Apple iPhone 13 128GB', '2500000.00', 'depan.jpeg', 'adadada', 2, 3, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_produk` bigint(20) NOT NULL,
  `jumlah_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_order`, `id_produk`, `harga_produk`, `jumlah_produk`) VALUES
(108, 98, 4, 2500000, 1),
(109, 98, 3, 2500000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `gambar_a` varchar(100) NOT NULL,
  `gambar_b` varchar(100) NOT NULL,
  `gambar_c` varchar(100) NOT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `harga_produk` decimal(10,2) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual` int(11) NOT NULL,
  `ukuran_layar` varchar(100) NOT NULL,
  `resolusi_kamera` varchar(100) NOT NULL,
  `k_penyimpanan` varchar(100) NOT NULL,
  `ram` varchar(100) NOT NULL,
  `fitur_handphone` varchar(100) NOT NULL,
  `tipe_processor` varchar(100) NOT NULL,
  `k_baterai` varchar(100) NOT NULL,
  `diskon` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar_a`, `gambar_b`, `gambar_c`, `deskripsi_produk`, `harga_produk`, `brand`, `stok`, `terjual`, `ukuran_layar`, `resolusi_kamera`, `k_penyimpanan`, `ram`, `fitur_handphone`, `tipe_processor`, `k_baterai`, `diskon`) VALUES
(3, 'Apple iPhone 13 128GB', 'ip12a.jpeg', 'ip12b.jpeg', 'ip12d.jpeg', 'adadada', '2500000.00', 'Apple', 125, 43, '6.1', '1170 x 2532 piksel', '128GB', '4GB', '[', 'Apple A15 Bionic', '3240 mAh', 5),
(4, 'Apple iPhone 11 64GB', 'depan.jpeg', 'belakang.jpeg', 'tengah.jpeg', 'keren', '2500000.00', 'Apple', 12, 10, '6.1', '1170 x 2532 piksel', '128GB', '4GB', '[\"Accelerometer\",\"Gyro\",\"Proximity\",\"Compass\",\"Barometer\",\"Ultra Wideband (UWB)\",\"Siri natural langu', 'Apple A15 Bionic', '3240 mAh', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_order` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `total_harga` bigint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_order`, `order_id`, `id_user`, `alamat_pengiriman`, `metode_pembayaran`, `tanggal_pesan`, `status`, `status_pembayaran`, `total_harga`) VALUES
(98, 'NAZAH-65b2a19800620', 8, 'acaa', 'gopay', '2024-01-25 17:59:52', 'Pending', 'denied', 7500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(5, 'zettaze', 'zettaa@zettaa.site', 'b92b52df66da4409b241dfbc244cd054'),
(6, 'z', 'zain@zettaa.site', '202cb962ac59075b964b07152d234b70'),
(7, 'demo', 'demo@example.com', 'fe01ce2a7fbac8fafaed7c982a04e229'),
(8, 'zetta', 'zetta@gmail.com', '7ac8712eccdcef3818d661bd287038e8'),
(9, 'demo1', 'demo1@gmail.com', 'fe01ce2a7fbac8fafaed7c982a04e229');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin1`
--
ALTER TABLE `admin1`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alamat_pembayaran` (`id_alamat`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin1`
--
ALTER TABLE `admin1`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`id_alamat`) REFERENCES `alamat` (`id_alamat`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `transaksi` (`id_order`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
