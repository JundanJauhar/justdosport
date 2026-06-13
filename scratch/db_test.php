<?php
include 'server/koneksi.php';
$res = $koneksi->query("SELECT id_pengguna, nama, email, role FROM pengguna");
while ($row = $res->fetch_assoc()) {
    echo "ID: " . $row['id_pengguna'] . " | Nama: " . $row['nama'] . " | Role: " . $row['role'] . "\n";
}
?>
