<?php
include '../server/koneksi.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $id_tempatFutsal = $_POST['id_tempatFutsal'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];

    $query = "INSERT INTO pemesanan (nama,  harga, id_tempatFutsal, tanggal, jam)
              VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($koneksi, $query)) {
        mysqli_stmt_bind_param($stmt, "ssssissss", $nama,  $harga, $id_tempatFutsal, $tanggal, $jam);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: hasilPembayaran.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request.";
}
?>
