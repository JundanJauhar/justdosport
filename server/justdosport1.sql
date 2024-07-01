-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 09:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justdosport1`
--

-- --------------------------------------------------------

--
-- Table structure for table `image_futsal`
--

CREATE TABLE `image_futsal` (
  `id_imageFutsal` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `id_tempatFutsal` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_futsal`
--

INSERT INTO `image_futsal` (`id_imageFutsal`, `image`, `id_tempatFutsal`) VALUES
(1, 'image1.jpg', 1),
(2, 'image2.jpg', 2),
(3, 'image3.jpg', 3),
(4, 'image4.jpg', 4),
(5, 'image5.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `durasi` datetime DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `subtotal_harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `nama_user`, `durasi`, `id_transaksi`, `subtotal_harga`) VALUES
(1, 'User 1', '2024-07-01 01:00:00', 1, 50000),
(2, 'User 2', '2024-07-02 01:00:00', 2, 60000),
(3, 'User 3', '2024-07-03 01:00:00', 3, 70000),
(4, 'User 4', '2024-07-04 01:00:00', 4, 80000),
(5, 'User 5', '2024-07-05 01:00:00', 5, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_lantai`
--

CREATE TABLE `jenis_lantai` (
  `id_lantai` int(11) NOT NULL,
  `jenis_lantai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_lantai`
--

INSERT INTO `jenis_lantai` (`id_lantai`, `jenis_lantai`) VALUES
(1, 'Vinyl'),
(2, 'Kayu'),
(3, 'Sintetis'),
(4, 'Rumput'),
(5, 'Karpet');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_lapangan`
--

CREATE TABLE `jenis_lapangan` (
  `id_jenisLapangan` int(11) NOT NULL,
  `jenis_lapangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_lapangan`
--

INSERT INTO `jenis_lapangan` (`id_jenisLapangan`, `jenis_lapangan`) VALUES
(1, 'Indoor'),
(2, 'Outdoor'),
(3, 'Semi-indoor'),
(4, 'Mini futsal'),
(5, 'Stadion futsal');

-- --------------------------------------------------------

--
-- Table structure for table `jumlah_user`
--

CREATE TABLE `jumlah_user` (
  `id_sum_user` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `mingguan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jumlah_user`
--

INSERT INTO `jumlah_user` (`id_sum_user`, `jumlah`, `mingguan`) VALUES
(1, 10, '2024-06-24'),
(2, 20, '2024-06-25'),
(3, 30, '2024-06-26'),
(4, 40, '2024-06-27'),
(5, 50, '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_tempatfutsla`
--

CREATE TABLE `keuangan_tempatfutsla` (
  `id_keuangan` int(11) NOT NULL,
  `id_tempatFutsal` bigint(20) DEFAULT NULL,
  `pemasukan` int(11) DEFAULT NULL,
  `mingguan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keuangan_tempatfutsla`
--

INSERT INTO `keuangan_tempatfutsla` (`id_keuangan`, `id_tempatFutsal`, `pemasukan`, `mingguan`) VALUES
(1, 1, 100000, '2024-06-24'),
(2, 2, 200000, '2024-06-25'),
(3, 3, 300000, '2024-06-26'),
(4, 4, 400000, '2024-06-27'),
(5, 5, 500000, '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(255) DEFAULT NULL,
  `id_lantai` int(11) DEFAULT NULL,
  `id_jenis_lapangan` int(11) DEFAULT NULL,
  `id_tempatFutsal` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `id_lantai`, `id_jenis_lapangan`, `id_tempatFutsal`) VALUES
(1, 'Lapangan 1', 1, 1, 1),
(2, 'Lapangan 2', 2, 2, 2),
(3, 'Lapangan 3', 3, 3, 3),
(4, 'Lapangan 4', 4, 4, 4),
(5, 'Lapangan 5', 5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `email`, `password`) VALUES
(1, 'operator1@example.com', 'password1'),
(2, 'operator2@example.com', 'password2'),
(3, 'operator3@example.com', 'password3'),
(4, 'operator4@example.com', 'password4'),
(5, 'operator5@example.com', 'password5');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `hari` date DEFAULT NULL,
  `minggu` date DEFAULT NULL,
  `bulanan` date DEFAULT NULL,
  `total_pemasukan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `hari`, `minggu`, `bulanan`, `total_pemasukan`) VALUES
(1, '2024-06-24', '2024-06-23', '2024-06-01', 1000000),
(2, '2024-06-25', '2024-06-23', '2024-06-01', 2000000),
(3, '2024-06-26', '2024-06-23', '2024-06-01', 3000000),
(4, '2024-06-27', '2024-06-23', '2024-06-01', 4000000),
(5, '2024-06-28', '2024-06-23', '2024-06-01', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` datetime DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `id_lapangan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tanggal`, `jam`, `harga`, `id_lapangan`) VALUES
(1, '2024-07-01', '2024-07-01 10:00:00', 50000, 1),
(2, '2024-07-02', '2024-07-02 11:00:00', 60000, 2),
(3, '2024-07-03', '2024-07-03 12:00:00', 70000, 3),
(4, '2024-07-04', '2024-07-04 13:00:00', 80000, 4),
(5, '2024-07-05', '2024-07-05 14:00:00', 90000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_mingguan`
--

CREATE TABLE `pemesanan_mingguan` (
  `id_pesan_mingguan` int(11) NOT NULL,
  `id_tempatFutsal` bigint(20) DEFAULT NULL,
  `jumlah_pemesanan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_mingguan`
--

INSERT INTO `pemesanan_mingguan` (`id_pesan_mingguan`, `id_tempatFutsal`, `jumlah_pemesanan`) VALUES
(1, 1, 5),
(2, 2, 10),
(3, 3, 15),
(4, 4, 20),
(5, 5, 25);

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE `pengelola` (
  `id_pengelola` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `NomorWA` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`id_pengelola`, `nama`, `email`, `password`, `NomorWA`) VALUES
(1, 'Pengelola 1', 'pengelola1@example.com', 'password1', 2147483647),
(2, 'Pengelola 2', 'pengelola2@example.com', 'password2', 2147483647),
(3, 'Pengelola 3', 'pengelola3@example.com', 'password3', 2147483647),
(4, 'Pengelola 4', 'pengelola4@example.com', 'password4', 2147483647),
(5, 'Pengelola 5', 'pengelola5@example.com', 'password5', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `email`, `password`) VALUES
(1, 'Pengguna 1', 'user1@example.com', 'password1'),
(2, 'Pengguna 2', 'user2@example.com', 'password2'),
(3, 'Pengguna 3', 'user3@example.com', 'password3'),
(4, 'Pengguna 4', 'user4@example.com', 'password4'),
(5, 'Pengguna 5', 'user5@example.com', 'password5');

-- --------------------------------------------------------

--
-- Table structure for table `tempatfutsal`
--

CREATE TABLE `tempatfutsal` (
  `id_tempatFutsal` bigint(20) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `kontak` bigint(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `kamar_mandi` tinyint(1) DEFAULT NULL,
  `musholla` tinyint(1) DEFAULT NULL,
  `lapangan` smallint(6) DEFAULT NULL,
  `parkir` tinyint(1) DEFAULT NULL,
  `id_pengelola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempatfutsal`
--

INSERT INTO `tempatfutsal` (`id_tempatFutsal`, `nama`, `harga`, `kontak`, `alamat`, `deskripsi`, `kamar_mandi`, `musholla`, `lapangan`, `parkir`, `id_pengelola`) VALUES
(1, 'Futsal Center A', 100000, 6281234567890, 'Jl. Futsal No.1', 'Tempat futsal dengan fasilitas lengkap', 1, 1, 3, 1, 0),
(2, 'Futsal Center B', 120000, 6281234567891, 'Jl. Futsal No.2', 'Tempat futsal dengan lapangan indoor', 1, 0, 2, 1, 0),
(3, 'Futsal Center C', 150000, 6281234567892, 'Jl. Futsal No.3', 'Tempat futsal dengan parkir luas', 1, 1, 4, 1, 0),
(4, 'Futsal Center D', 80000, 6281234567893, 'Jl. Futsal No.4', 'Tempat futsal dengan harga terjangkau', 0, 0, 1, 0, 0),
(5, 'Futsal Center E', 110000, 6281234567894, 'Jl. Futsal No.5', 'Tempat futsal dengan lapangan sintetis', 1, 1, 3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image_futsal`
--
ALTER TABLE `image_futsal`
  ADD PRIMARY KEY (`id_imageFutsal`),
  ADD KEY `id_tempatFutsal` (`id_tempatFutsal`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `jenis_lantai`
--
ALTER TABLE `jenis_lantai`
  ADD PRIMARY KEY (`id_lantai`);

--
-- Indexes for table `jenis_lapangan`
--
ALTER TABLE `jenis_lapangan`
  ADD PRIMARY KEY (`id_jenisLapangan`);

--
-- Indexes for table `jumlah_user`
--
ALTER TABLE `jumlah_user`
  ADD PRIMARY KEY (`id_sum_user`);

--
-- Indexes for table `keuangan_tempatfutsla`
--
ALTER TABLE `keuangan_tempatfutsla`
  ADD PRIMARY KEY (`id_keuangan`),
  ADD KEY `id_tempatFutsal` (`id_tempatFutsal`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`),
  ADD KEY `id_lantai` (`id_lantai`),
  ADD KEY `id_jenis_lapangan` (`id_jenis_lapangan`),
  ADD KEY `id_tempatFutsal` (`id_tempatFutsal`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_lapangan` (`id_lapangan`);

--
-- Indexes for table `pemesanan_mingguan`
--
ALTER TABLE `pemesanan_mingguan`
  ADD PRIMARY KEY (`id_pesan_mingguan`),
  ADD KEY `id_tempatFutsal` (`id_tempatFutsal`);

--
-- Indexes for table `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`id_pengelola`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tempatfutsal`
--
ALTER TABLE `tempatfutsal`
  ADD PRIMARY KEY (`id_tempatFutsal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image_futsal`
--
ALTER TABLE `image_futsal`
  MODIFY `id_imageFutsal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_lantai`
--
ALTER TABLE `jenis_lantai`
  MODIFY `id_lantai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_lapangan`
--
ALTER TABLE `jenis_lapangan`
  MODIFY `id_jenisLapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jumlah_user`
--
ALTER TABLE `jumlah_user`
  MODIFY `id_sum_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keuangan_tempatfutsla`
--
ALTER TABLE `keuangan_tempatfutsla`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan_mingguan`
--
ALTER TABLE `pemesanan_mingguan`
  MODIFY `id_pesan_mingguan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `id_pengelola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tempatfutsal`
--
ALTER TABLE `tempatfutsal`
  MODIFY `id_tempatFutsal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image_futsal`
--
ALTER TABLE `image_futsal`
  ADD CONSTRAINT `image_futsal_ibfk_1` FOREIGN KEY (`id_tempatFutsal`) REFERENCES `tempatfutsal` (`id_tempatFutsal`);

--
-- Constraints for table `keuangan_tempatfutsla`
--
ALTER TABLE `keuangan_tempatfutsla`
  ADD CONSTRAINT `keuangan_tempatfutsla_ibfk_1` FOREIGN KEY (`id_tempatFutsal`) REFERENCES `tempatfutsal` (`id_tempatFutsal`);

--
-- Constraints for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD CONSTRAINT `lapangan_ibfk_1` FOREIGN KEY (`id_lantai`) REFERENCES `jenis_lantai` (`id_lantai`),
  ADD CONSTRAINT `lapangan_ibfk_2` FOREIGN KEY (`id_jenis_lapangan`) REFERENCES `jenis_lapangan` (`id_jenisLapangan`),
  ADD CONSTRAINT `lapangan_ibfk_3` FOREIGN KEY (`id_tempatFutsal`) REFERENCES `tempatfutsal` (`id_tempatFutsal`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`);

--
-- Constraints for table `pemesanan_mingguan`
--
ALTER TABLE `pemesanan_mingguan`
  ADD CONSTRAINT `pemesanan_mingguan_ibfk_1` FOREIGN KEY (`id_tempatFutsal`) REFERENCES `tempatfutsal` (`id_tempatFutsal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
