<?php
include '../server/koneksi.php';

// Lapangan dengan gambar dari Unsplash (Futsal Spesifik)
$lapanganData = [
    [
        'nama' => 'Jakal 7 Futsal',
        'harga' => 90000,
        'alamat' => 'Jl. Kaliurang, Km. 7, Yogyakarta',
        'fasilitas' => 'Parkir, Kamar Mandi, Musholla, Kantin',
        'kontak' => '(0274) 880864',
        'gambar' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop',
        'ket' => 'Lapangan futsal berkualitas dengan 3 lapangan indoor nyaman dan fasilitas lengkap.'
    ],
    [
        'nama' => 'Meteor Futsal',
        'harga' => 100000,
        'alamat' => 'Jl. Kaliurang, Km 12.5, Yogyakarta',
        'fasilitas' => 'Parkir Luas, Kamar Mandi, Musholla, Kantin, AC',
        'kontak' => '0888-0687-9888',
        'gambar' => 'https://images.unsplash.com/photo-1552667449-8631fc08231f?w=800&h=600&fit=crop',
        'ket' => 'Futsal premium dengan standar internasional dan fasilitas modern untuk pertandingan berkualitas.'
    ],
    [
        'nama' => 'Lapangan Futsal Bardosono',
        'harga' => 80000,
        'alamat' => 'Bardosono Area, Yogyakarta',
        'fasilitas' => 'Parkir, Kamar Mandi, Tempat Istirahat',
        'kontak' => '0812-3456-7890',
        'gambar' => 'https://images.unsplash.com/photo-1534158914592-062992fbe900?w=800&h=600&fit=crop',
        'ket' => 'Lapangan futsal terjangkau dengan lokasi strategis, sempurna untuk latihan dan turnamen.'
    ],
    [
        'nama' => 'Green Field Futsal',
        'harga' => 110000,
        'alamat' => 'Jl. Pemuda No. 45, Yogyakarta',
        'fasilitas' => 'Parkir, Kamar Mandi Premium, Musholla, Cafe, WiFi',
        'kontak' => '0274-2345678',
        'gambar' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop',
        'ket' => 'Futsal modern dengan fasilitas premium dan area istirahat yang nyaman untuk semua pemain.'
    ],
    [
        'nama' => 'Futsal Pro Arena',
        'harga' => 95000,
        'alamat' => 'Jl. Diponegoro No. 12, Yogyakarta',
        'fasilitas' => 'Parkir Multilevel, Kamar Mandi Mewah, Musholla, Resto',
        'kontak' => '0274-9876543',
        'gambar' => 'https://images.unsplash.com/photo-1556821552-5c63f2b6bef8?w=800&h=600&fit=crop',
        'ket' => 'Arena futsal premium dengan layanan terbaik dan fasilitas mewah untuk acara olahraga profesional.'
    ]
];

// Hapus data lama jika ada (opsional)
// $deleteQuery = "TRUNCATE TABLE lapangan";
// mysqli_query($koneksi, $deleteQuery);

// Insert data baru
$count = 0;
foreach ($lapanganData as $data) {
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $fasilitas = mysqli_real_escape_string($koneksi, $data['fasilitas']);
    $kontak = mysqli_real_escape_string($koneksi, $data['kontak']);
    $gambar = mysqli_real_escape_string($koneksi, $data['gambar']);
    $ket = mysqli_real_escape_string($koneksi, $data['ket']);

    $query = "INSERT INTO lapangan (namaLapangan, harga, alamat, fasilitas, kontakLapangan, gambar, ketlapangan) 
              VALUES ('$nama', '$harga', '$alamat', '$fasilitas', '$kontak', '$gambar', '$ket')";

    if (mysqli_query($koneksi, $query)) {
        $count++;
        echo "<div style='color: green;'>✓ Berhasil menambah: $nama</div>";
    } else {
        echo "<div style='color: red;'>✗ Error: " . mysqli_error($koneksi) . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seed Data</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        div { padding: 5px; }
    </style>
</head>
<body>
    <h2>Database Seed Lapangan Futsal</h2>
    <p>Total data berhasil ditambahkan: <strong><?php echo $count; ?></strong></p>
    <a href="../admin/index.php">← Kembali ke Admin Panel</a>
</body>
</html>
