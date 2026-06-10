<?php
    include '../server/koneksi.php';
function getDataTempatFutsal($conn) {
    $query = "SELECT id_tempatFutsal, nama, harga, jenis_lantai, jenis_lapangan FROM tempat_futsal ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return [];
    }
}

?>