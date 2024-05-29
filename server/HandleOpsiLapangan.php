<?php
// Include file koneksi.php
include '../server/koneksi.php';

// Query untuk mengambil data lapangan dari database
$sql = "SELECT * FROM lapangan";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan data lapangan
$lapanganList = array();

// Periksa jika query berhasil dieksekusi dan menghasilkan data
if ($result->num_rows > 0) {
    // Ambil setiap baris data dan masukkan ke dalam array
    while ($row = $result->fetch_assoc()) {
        $lapanganList[] = $row;
    }
} else {
    // Jika tidak ada data ditemukan, set array lapanganList kosong
    $lapanganList = array();
}

// Tutup koneksi ke database
$conn->close();
?>