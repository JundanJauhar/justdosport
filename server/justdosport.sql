-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2024 pada 10.49
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
-- Struktur dari tabel `pilihanwaktu`
--

CREATE TABLE `pilihanwaktu` (
  `idWaktu` int(11) NOT NULL,
  `idLapangan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `menit` int(11) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pilihanwaktu`
--

INSERT INTO `pilihanwaktu` (`idWaktu`, `idLapangan`, `tanggal`, `menit`, `jam`, `harga`) VALUES
(1, 1, '2024-06-23', 60, '09:00 - 10:00', 120000),
(2, 1, '2024-06-23', 60, '09:00 - 10:00', 120000),
(3, 2, '2024-06-23', 60, '10:00 - 11:00', 130000),
(4, 2, '2024-06-23', 60, '10:00 - 11:00', 130000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pilihanwaktu`
--
ALTER TABLE `pilihanwaktu`
  ADD PRIMARY KEY (`idWaktu`),
  ADD KEY `idLapangan` (`idLapangan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pilihanwaktu`
--
ALTER TABLE `pilihanwaktu`
  MODIFY `idWaktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pilihanwaktu`
--
ALTER TABLE `pilihanwaktu`
  ADD CONSTRAINT `pilihanwaktu_ibfk_1` FOREIGN KEY (`idLapangan`) REFERENCES `pilihanlapangan` (`idPilihan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
