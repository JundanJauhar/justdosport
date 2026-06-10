-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2024 pada 07.43
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justdosport`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(255) DEFAULT NULL,
  `id_lantai` int(11) DEFAULT NULL,
  `id_jenisLapangan` int(11) DEFAULT NULL,
  `id_tempatFutsal` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `id_lantai`, `id_jenisLapangan`, `id_tempatFutsal`) VALUES
(1, 'Lapangan 1', 1, 1, 1),
(2, 'Lapangan 2', 2, 2, 2),
(3, 'Lapangan 3', 3, 3, 3),
(4, 'Lapangan 4', 4, 4, 4),
(5, 'Lapangan 5', 5, 5, 5),
(6, 'Lapangan 7', 5, 2, 1),
(7, 'Lapangan 2', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`),
  ADD KEY `id_lantai` (`id_lantai`),
  ADD KEY `id_jenis_lapangan` (`id_jenisLapangan`),
  ADD KEY `id_tempatFutsal` (`id_tempatFutsal`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD CONSTRAINT `lapangan_ibfk_1` FOREIGN KEY (`id_lantai`) REFERENCES `jenis_lantai` (`id_lantai`),
  ADD CONSTRAINT `lapangan_ibfk_2` FOREIGN KEY (`id_jenisLapangan`) REFERENCES `jenis_lapangan` (`id_jenisLapangan`),
  ADD CONSTRAINT `lapangan_ibfk_3` FOREIGN KEY (`id_tempatFutsal`) REFERENCES `tempatfutsal` (`id_tempatFutsal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
