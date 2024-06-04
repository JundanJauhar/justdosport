-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2024 pada 09.16
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
  `id` int(255) NOT NULL,
  `namaLapangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `fasilitas` text NOT NULL,
  `kontakLapangan` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id`, `namaLapangan`, `harga`, `alamat`, `fasilitas`, `kontakLapangan`, `gambar`) VALUES
(1, 'Jakal 7 Futsal', 90000, 'Jl. Kaliurang, Km. 7', 'Kamar Mandi, Mushollah, Lapangan (3)', '(0274) 880864', 'https://lh3.googleusercontent.com/p/AF1QipM8mmdwhKOqq36LvO9wLRXWoPXFSQJ6ZGDCf4F6=s1360-w1360-h1020'),
(2, 'Meteor Futsal', 100000, 'Jl. Kaliurang, Km 12.5 ', 'Kamar Mandi, Mushollah, Lapangan (3)', '0888-0687-9888', 'https://lh3.googleusercontent.com/p/AF1QipPAxaM444LfDWbPvVWW-Q9iLy-wUD2FC4vEmcEv=s1360-w1360-h1020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihanlapangan`
--

CREATE TABLE `pilihanlapangan` (
  `idPilihan` int(255) NOT NULL,
  `cabor` varchar(255) NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `lantai` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pilihanlapangan`
--

INSERT INTO `pilihanlapangan` (`idPilihan`, `cabor`, `ruangan`, `lantai`, `img`) VALUES
(1, 'Futsal', 'Indoor', 'Vinyl', 'https://pbs.twimg.com/media/DuSIEZSUUAAj_Nw.jpg'),
(3, 'Futsal', 'indoor', '2', ''),
(4, 'Futsal', 'indoor', '2', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihanwaktu`
--

CREATE TABLE `pilihanwaktu` (
  `idWaktu` int(225) NOT NULL,
  `id` int(255) NOT NULL,
  `menit` int(11) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pilihanwaktu`
--

INSERT INTO `pilihanwaktu` (`idWaktu`, `id`, `menit`, `jam`, `harga`) VALUES
(1, 1, 60, '07.00 - 08.00', 120000),
(3, 1, 60, '08.00 - 09.00', 130000),
(4, 1, 60, '08.00 - 09.00', 130000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pilihanlapangan`
--
ALTER TABLE `pilihanlapangan`
  ADD PRIMARY KEY (`idPilihan`);

--
-- Indeks untuk tabel `pilihanwaktu`
--
ALTER TABLE `pilihanwaktu`
  ADD PRIMARY KEY (`idWaktu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pilihanlapangan`
--
ALTER TABLE `pilihanlapangan`
  MODIFY `idPilihan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pilihanwaktu`
--
ALTER TABLE `pilihanwaktu`
  MODIFY `idWaktu` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
