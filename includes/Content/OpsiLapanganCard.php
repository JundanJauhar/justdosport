<?php 
include '../../server/HandleOpsiLapangan.php';

$sql = "SELECT * FROM lapangan";
$result = $conn->query($sql);
$lapanganList = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lapanganList[] = $row;
    }
}

foreach ($lapanganList as $row) {
    $gambar = htmlspecialchars($row['gambar']);
    $namaLapangan = htmlspecialchars($row['namaLapangan']);
    $alamat = htmlspecialchars($row['alamat']);
    $harga = htmlspecialchars(number_format($row['harga'], 0, ',', '.'));
    $fasilitas = htmlspecialchars($row['fasilitas']);
    $kontakLapangan = htmlspecialchars($row['kontakLapangan']);
    
    echo "
    <div class='w-96 border rounded-sm shadow-md p-4' style='background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);'>
        <img src='$gambar' alt='gambar' class='w-full h-80 object-cover rounded-sm' />
        <h4 class='text-2xl font-semibold mt-2 text-white'>$namaLapangan</h4>
        <h4 class='text-sm font-normal mt-2 text-gray-300'>$alamat</h4>
        <h4 class='text-lg font-semibold text-white'>Rp. $harga / Jam</h4>
        <h4 class='text-lg font-semibold text-white'>Fasilitas</h4>
        <p class='text-sm font-normal text-gray-300'>$fasilitas</p>
        <h4 class='text-2xl font-semibold mt-2 text-white'>$kontakLapangan</h4>
        <button class='bg-green-500 text-white rounded-md px-3 py-2  transition duration-300 mt-2'>Pesan</button>
    </div>
    ";
}
?>