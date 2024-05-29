-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2024 at 12:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
-- Table structure for table `lapangan`
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
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `namaLapangan`, `harga`, `alamat`, `fasilitas`, `kontakLapangan`, `gambar`) VALUES
(1, 'Jakal 7 Futsal', 90000, 'Jl. Kaliurang, Km. 7', 'Kamar Mandi, Mushollah, Lapangan (3)', '(0274) 880864', 'https://lh3.googleusercontent.com/p/AF1QipM8mmdwhKOqq36LvO9wLRXWoPXFSQJ6ZGDCf4F6=s1360-w1360-h1020'),
(2, 'Meteor Futsal', 100000, 'Jl. Kaliurang, Km 12.5 ', 'Kamar Mandi, Mushollah, Lapangan (3)', '0888-0687-9888', 'https://lh3.googleusercontent.com/p/AF1QipPAxaM444LfDWbPvVWW-Q9iLy-wUD2FC4vEmcEv=s1360-w1360-h1020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
