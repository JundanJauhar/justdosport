<?php
// Include file koneksi.php
include '../server/koneksi.php';

// Query untuk mengambil data lapangan dari database
$sql = "SELECT * FROM pilihanlapangan";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan data lapangan
$pilihanlapanganList = array();

// Periksa jika query berhasil dieksekusi dan menghasilkan data
if ($result->num_rows > 0) {
    // Ambil setiap baris data dan masukkan ke dalam array
    while ($row = $result->fetch_assoc()) {
        $pilihanlapanganList[] = $row;
    }
} else {
    // Jika tidak ada data ditemukan, set array lapanganList kosong
    $pilihanlapanganList = array();
}

// Tutup koneksi ke database
$conn->close();
?>