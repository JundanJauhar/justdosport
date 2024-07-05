<?php

$host = "localhost"; // Host database
$username = "root"; // Username database
$password = ""; // Password database
$database = "justdosport"; // Nama database

// Membuat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
    echo "". $koneksi->error;

} 

return [
    'DB_HOST' => 'localhost',
    'DB_DATABASE' => 'nama_database',
    'DB_USERNAME' => 'username_database',
    'DB_PASSWORD' => 'password_database'
];


// Mengatur karakter set
$koneksi->set_charset("utf8");

// Menambahkan variabel $conn ke global
global $conn;
$conn = $koneksi;
?>