<?php
include __DIR__ . '/../server/koneksi.php';

echo "--- Pengguna ---\n";
$res = $koneksi->query("SELECT * FROM pengguna");
while ($row = $res->fetch_assoc()) {
    print_r($row);
}

echo "\n--- Lapangan ---\n";
$res2 = $koneksi->query("SELECT id, namaLapangan, cabor, id_pemilik FROM lapangan");
while ($row = $res2->fetch_assoc()) {
    print_r($row);
}
?>
