-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jun 2024 pada 05.13
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
  `id` int(11) NOT NULL,
  `namaLapangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `fasilitas` text NOT NULL,
  `kontakLapangan` text NOT NULL,
  `gambar` text NOT NULL,
  `ketlapangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id`, `namaLapangan`, `harga`, `alamat`, `fasilitas`, `kontakLapangan`, `gambar`, `ketlapangan`) VALUES
(1, 'Jakal 7 Futsal', 90000, 'Jl. Kaliurang, Km. 7', '[\"3 Lapangan\", \"Kamar Mandi\", \"Musholla\", \"Area Parkir\"]', '(0274) 880864', 'https://lh3.googleusercontent.com/p/AF1QipM8mmdwhKOqq36LvO9wLRXWoPXFSQJ6ZGDCf4F6=s1360-w1360-h1020', 'Jakal Km 7 Futsal adalah sebuah lapangan futsal yang terletak di Jalan Kaliurang kilometer 7, Yogyakarta. Lokasinya yang strategis di sepanjang salah satu jalan utama di Yogyakarta membuatnya mudah diakses oleh para penggemar futsal dari berbagai penjuru kota. Berikut adalah beberapa deskripsi umum tentang Jakal Km 7 Futsal:\r\n\r\nFasilitas Lapangan:\r\n\r\nLapangan futsal dengan ukuran standar internasional.\r\nPermukaan lapangan biasanya terbuat dari bahan yang aman dan nyaman untuk bermain, seperti rumput sintetis atau material khusus futsal.\r\nPencahayaan yang baik untuk memungkinkan permainan di malam hari.\r\nFasilitas Pendukung:\r\n\r\nArea parkir yang cukup luas untuk menampung kendaraan pengunjung.\r\nRuang ganti dan kamar mandi yang bersih dan memadai.\r\nKantin atau tempat istirahat untuk para pemain dan penonton.\r\nPelayanan:\r\n\r\nSistem reservasi yang mudah, baik secara langsung di lokasi maupun melalui telepon atau aplikasi.\r\nStaff yang ramah dan profesional, siap membantu kebutuhan para pemain.\r\nKomunitas dan Event:\r\n\r\nTempat ini sering digunakan untuk berbagai turnamen futsal, baik lokal maupun regional.\r\nSering menjadi tempat berkumpulnya komunitas futsal dari berbagai kalangan, mulai dari pelajar hingga pekerja.\r\nHarga Sewa:\r\n\r\nBiaya sewa lapangan yang kompetitif dan terjangkau.\r\nBiasanya tersedia berbagai paket sewa, dari sewa per jam hingga paket langganan bulanan.\r\nDengan fasilitas yang lengkap dan lokasi yang strategis, Jakal Km 7 Futsal menjadi salah satu pilihan utama bagi para penggemar futsal di Yogyakarta untuk bermain dan berolahraga.\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(2, 'Meteor Futsal', 100000, 'Jl. Kaliurang, Km 12.5 ', '[\"3 Lapangan\", \"Kamar Mandi\", \"Musholla\", \"Area Parkir\"]', '0888-0687-9888', 'https://lh3.googleusercontent.com/p/AF1QipPAxaM444LfDWbPvVWW-Q9iLy-wUD2FC4vEmcEv=s1360-w1360-h1020', 'Meteor Futsal adalah salah satu fasilitas futsal yang terletak di Yogyakarta. Berikut adalah deskripsi umum tentang Meteor Futsal:\r\n\r\nFasilitas Lapangan:\r\n\r\nLapangan: Meteor Futsal memiliki beberapa lapangan futsal dengan ukuran standar internasional. Permukaan lapangan biasanya terbuat dari rumput sintetis berkualitas tinggi atau bahan khusus futsal lainnya yang memastikan kenyamanan dan keamanan bermain.\r\nPencahayaan: Sistem pencahayaan yang baik dan merata memungkinkan permainan berlangsung dengan nyaman, bahkan di malam hari.\r\nFasilitas Pendukung:\r\n\r\nParkir: Area parkir yang luas untuk menampung kendaraan pemain dan penonton.\r\nRuang Ganti dan Kamar Mandi: Tersedia ruang ganti yang bersih dan nyaman serta kamar mandi dengan fasilitas shower.\r\nKantin: Kantin atau area istirahat yang menyediakan berbagai makanan dan minuman ringan untuk pemain dan penonton.\r\nPelayanan:\r\n\r\nReservasi: Sistem reservasi yang mudah dan efisien, bisa dilakukan langsung di lokasi atau melalui telepon dan aplikasi.\r\nStaff: Staff yang profesional dan ramah, selalu siap membantu kebutuhan para pengunjung.\r\nKomunitas dan Event:\r\n\r\nTurnamen: Meteor Futsal sering menjadi tuan rumah berbagai turnamen futsal, mulai dari tingkat lokal hingga regional, menarik banyak tim dan penonton.\r\nKomunitas: Tempat ini sering digunakan sebagai tempat berkumpulnya komunitas futsal dari berbagai kalangan, menciptakan lingkungan yang aktif dan dinamis.\r\nHarga Sewa:\r\n\r\nBiaya Sewa: Meteor Futsal menawarkan harga sewa yang kompetitif dan beragam, dengan pilihan sewa per jam hingga paket langganan.\r\nPromosi: Terkadang ada promosi atau diskon khusus untuk waktu-waktu tertentu atau bagi pelanggan tetap.\r\nDengan fasilitas yang lengkap dan pelayanan yang baik, Meteor Futsal menjadi salah satu pilihan favorit bagi para penggemar futsal di Yogyakarta untuk berlatih, bertanding, atau sekadar bermain bersama teman-teman.'),
(3, 'Bardosono', 130000, 'Bardosono Area', '[\"parkir\"]', '1234555', '', 'ini keren'),
(4, 'Jakal 7 Futsal', 90000, 'Jl. Kaliurang, Km. 7', '[\"3 Lapangan\", \"Kamar Mandi\", \"Musholla\", \"Area Parkir\"]', '(0274) 880864', 'https://lh3.googleusercontent.com/p/AF1QipM8mmdwhKOqq36LvO9wLRXWoPXFSQJ6ZGDCf4F6=s1360-w1360-h1020', 'Jakal Km 7 Futsal adalah sebuah lapangan futsal yang terletak di Jalan Kaliurang kilometer 7, Yogyakarta. Lokasinya yang strategis di sepanjang salah satu jalan utama di Yogyakarta membuatnya mudah diakses oleh para penggemar futsal dari berbagai penjuru kota. Berikut adalah beberapa deskripsi umum tentang Jakal Km 7 Futsal:\r\n\r\nFasilitas Lapangan:\r\n\r\nLapangan futsal dengan ukuran standar internasional.\r\nPermukaan lapangan biasanya terbuat dari bahan yang aman dan nyaman untuk bermain, seperti rumput sintetis atau material khusus futsal.\r\nPencahayaan yang baik untuk memungkinkan permainan di malam hari.\r\nFasilitas Pendukung:\r\n\r\nArea parkir yang cukup luas untuk menampung kendaraan pengunjung.\r\nRuang ganti dan kamar mandi yang bersih dan memadai.\r\nKantin atau tempat istirahat untuk para pemain dan penonton.\r\nPelayanan:\r\n\r\nSistem reservasi yang mudah, baik secara langsung di lokasi maupun melalui telepon atau aplikasi.\r\nStaff yang ramah dan profesional, siap membantu kebutuhan para pemain.\r\nKomunitas dan Event:\r\n\r\nTempat ini sering digunakan untuk berbagai turnamen futsal, baik lokal maupun regional.\r\nSering menjadi tempat berkumpulnya komunitas futsal dari berbagai kalangan, mulai dari pelajar hingga pekerja.\r\nHarga Sewa:\r\n\r\nBiaya sewa lapangan yang kompetitif dan terjangkau.\r\nBiasanya tersedia berbagai paket sewa, dari sewa per jam hingga paket langganan bulanan.\r\nDengan fasilitas yang lengkap dan lokasi yang strategis, Jakal Km 7 Futsal menjadi salah satu pilihan utama bagi para penggemar futsal di Yogyakarta untuk bermain dan berolahraga.\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(5, 'Jakal 7 Futsal', 90000, 'Jl. Kaliurang, Km. 7', '[\"3 Lapangan\", \"Kamar Mandi\", \"Musholla\", \"Area Parkir\"]', '(0274) 880864', 'https://lh3.googleusercontent.com/p/AF1QipM8mmdwhKOqq36LvO9wLRXWoPXFSQJ6ZGDCf4F6=s1360-w1360-h1020', 'Jakal Km 7 Futsal adalah sebuah lapangan futsal yang terletak di Jalan Kaliurang kilometer 7, Yogyakarta. Lokasinya yang strategis di sepanjang salah satu jalan utama di Yogyakarta membuatnya mudah diakses oleh para penggemar futsal dari berbagai penjuru kota. Berikut adalah beberapa deskripsi umum tentang Jakal Km 7 Futsal:\r\n\r\nFasilitas Lapangan:\r\n\r\nLapangan futsal dengan ukuran standar internasional.\r\nPermukaan lapangan biasanya terbuat dari bahan yang aman dan nyaman untuk bermain, seperti rumput sintetis atau material khusus futsal.\r\nPencahayaan yang baik untuk memungkinkan permainan di malam hari.\r\nFasilitas Pendukung:\r\n\r\nArea parkir yang cukup luas untuk menampung kendaraan pengunjung.\r\nRuang ganti dan kamar mandi yang bersih dan memadai.\r\nKantin atau tempat istirahat untuk para pemain dan penonton.\r\nPelayanan:\r\n\r\nSistem reservasi yang mudah, baik secara langsung di lokasi maupun melalui telepon atau aplikasi.\r\nStaff yang ramah dan profesional, siap membantu kebutuhan para pemain.\r\nKomunitas dan Event:\r\n\r\nTempat ini sering digunakan untuk berbagai turnamen futsal, baik lokal maupun regional.\r\nSering menjadi tempat berkumpulnya komunitas futsal dari berbagai kalangan, mulai dari pelajar hingga pekerja.\r\nHarga Sewa:\r\n\r\nBiaya sewa lapangan yang kompetitif dan terjangkau.\r\nBiasanya tersedia berbagai paket sewa, dari sewa per jam hingga paket langganan bulanan.\r\nDengan fasilitas yang lengkap dan lokasi yang strategis, Jakal Km 7 Futsal menjadi salah satu pilihan utama bagi para penggemar futsal di Yogyakarta untuk bermain dan berolahraga.\r\n\r\n\r\n\r\n\r\n\r\n\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihanlapangan`
--

CREATE TABLE `pilihanlapangan` (
  `idPilihan` int(11) NOT NULL,
  `idFutsal` int(11) NOT NULL,
  `cabor` varchar(255) NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `lantai` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pilihanlapangan`
--

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
(2, 2, '2024-06-23', 60, '10:00 - 11:00', 130000);

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
  ADD PRIMARY KEY (`idPilihan`),
  ADD KEY `idFutsal` (`idFutsal`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pilihanlapangan`
--
ALTER TABLE `pilihanlapangan`
  MODIFY `idPilihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pilihanwaktu`
--
ALTER TABLE `pilihanwaktu`
  MODIFY `idWaktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pilihanlapangan`
--
ALTER TABLE `pilihanlapangan`
  ADD CONSTRAINT `pilihanlapangan_ibfk_1` FOREIGN KEY (`idFutsal`) REFERENCES `lapangan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
