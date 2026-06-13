<?php

$host = "localhost"; // Host database
$username = "root"; // Username database
$password = "password123"; // Password database
$database = "justdosport"; // Nama database

// Membuat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
    echo "". $koneksi->error;

} 



// Mengatur karakter set
$koneksi->set_charset("utf8");

// Membuat tabel pengguna jika belum ada
$koneksi->query("CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Membuat tabel pemesanan jika belum ada
$koneksi->query("CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lapangan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `nama_kustomer` varchar(255) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `status_pembayaran` varchar(50) DEFAULT 'Belum Dibayar',
  `no_transaksi` varchar(100) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Membuat tabel notifikasi jika belum ada
$koneksi->query("CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pemilik` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Membuat tabel ulasan jika belum ada
$koneksi->query("CREATE TABLE IF NOT EXISTS `ulasan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lapangan` int(11) NOT NULL,
  `nama_kustomer` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL,
  `komentar` text NOT NULL,
  `analisis_sentimen` varchar(50) DEFAULT 'Netral',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

// Menambahkan variabel $conn ke global
// Check if 'role' column exists in 'pengguna'
$res_role = $koneksi->query("SHOW COLUMNS FROM `pengguna` LIKE 'role'");
if ($res_role && $res_role->num_rows == 0) {
    $koneksi->query("ALTER TABLE `pengguna` ADD COLUMN `role` VARCHAR(50) DEFAULT 'customer'");
}

// Check if 'id_pemilik' column exists in 'lapangan'
$res_pemilik = $koneksi->query("SHOW COLUMNS FROM `lapangan` LIKE 'id_pemilik'");
if ($res_pemilik && $res_pemilik->num_rows == 0) {
    $koneksi->query("ALTER TABLE `lapangan` ADD COLUMN `id_pemilik` INT(11) DEFAULT NULL");
}

// Check if 'cabor' column exists in 'lapangan'
$res_cabor = $koneksi->query("SHOW COLUMNS FROM `lapangan` LIKE 'cabor'");
if ($res_cabor && $res_cabor->num_rows == 0) {
    $koneksi->query("ALTER TABLE `lapangan` ADD COLUMN `cabor` VARCHAR(50) DEFAULT 'Futsal'");
}

global $conn;
$conn = $koneksi;
?>