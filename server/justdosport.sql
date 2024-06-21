-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2024 pada 09:16
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaLapangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `fasilitas` text NOT NULL,
  `kontakLapangan` text NOT NULL,
  `gambar` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id`, `namaLapangan`, `harga`, `alamat`, `fasilitas`, `kontakLapangan`, `gambar`) VALUES
(1, 'Jakal 7 Futsal', 90000, 'Jl. Kaliurang, Km. 7', '["3 Lapangan", "Kamar Mandi", "Musholla", "Area Parkir"]', '(0274) 880864', 'https://lh3.googleusercontent.com/p/AF1QipM8mmdwhKOqq36LvO9wLRXWoPXFSQJ6ZGDCf4F6=s1360-w1360-h1020'),
(2, 'Meteor Futsal', 100000, 'Jl. Kaliurang, Km 12.5 ', '["3 Lapangan", "Kamar Mandi", "Musholla", "Area Parkir"]', '0888-0687-9888', 'https://lh3.googleusercontent.com/p/AF1QipPAxaM444LfDWbPvVWW-Q9iLy-wUD2FC4vEmcEv=s1360-w1360-h1020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihanlapangan`
--

CREATE TABLE `pilihanlapangan` (
  `idPilihan` int(11) NOT NULL AUTO_INCREMENT,
  `idFutsal` int(11) NOT NULL,
  `cabor` varchar(255) NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `lantai` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`idPilihan`),
  FOREIGN KEY (`idFutsal`) REFERENCES `lapangan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Dumping data untuk tabel `pilihanlapangan`
--

-- Insert data into pilihanlapangan table
INSERT INTO `pilihanlapangan` (`idPilihan`, `idFutsal`, `cabor`, `ruangan`, `lantai`, `img`) VALUES
(1, 1, 'Futsal', 'Indoor', 'Vinyl', 'https://pbs.twimg.com/media/DuSIEZSUUAAj_Nw.jpg'),
(2, 1, 'Futsal', 'Indoor', 'Vinyl', ''),
(3, 2, 'Futsal', 'indoor', '2', ''),
(4, 2, 'Futsal', 'indoor', '2', '');


-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihanwaktu`
--

CREATE TABLE `pilihanwaktu` (
  `idWaktu` int(11) NOT NULL AUTO_INCREMENT,
  `idLapangan` int(11) NOT NULL,
  `menit` int(11) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`idWaktu`),
  FOREIGN KEY (`idLapangan`) REFERENCES `pilihanlapangan`(`idPilihan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pilihanwaktu`
--

INSERT INTO `pilihanwaktu` (`idWaktu`, `idLapangan`, `menit`, `jam`, `harga`) VALUES
(1, 1, 60, '09:00 - 10:00', 120000),
(2, 2, 60, '10:00 - 11:00', 130000);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
