<?php
include '../server/koneksi.php';

/**
 * SCRIPT UNTUK UPDATE GAMBAR LAPANGAN FUTSAL - VERSI OPTIMIZED
 * Menggunakan gambar futsal berkualitas tinggi dari berbagai sumber yang reliable
 */

// Koleksi gambar futsal spesifik yang sudah diverifikasi bagus
$gambarFutsal = [
    // Unsplash - Indoor Soccer / Futsal
    'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop',  // Futsal players game action
    'https://images.unsplash.com/photo-1552667449-8631fc08231f?w=800&h=600&fit=crop',  // Indoor court futsal
    'https://images.unsplash.com/photo-1534158914592-062992fbe900?w=800&h=600&fit=crop',  // Soccer field close-up
    'https://images.unsplash.com/photo-1556821552-5c63f2b6bef8?w=800&h=600&fit=crop',  // Soccer players action
    'https://images.unsplash.com/photo-1445049976739-d2cecac38203?w=800&h=600&fit=crop',  // Team soccer game
    // Perulangan gambar baik untuk mengisi sisa slots
    'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop',
    'https://images.unsplash.com/photo-1552667449-8631fc08231f?w=800&h=600&fit=crop',
    'https://images.unsplash.com/photo-1534158914592-062992fbe900?w=800&h=600&fit=crop',
    'https://images.unsplash.com/photo-1556821552-5c63f2b6bef8?w=800&h=600&fit=crop',
    'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop',
];

// Query untuk ambil semua lapangan
$query = "SELECT id, namaLapangan FROM lapangan ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);

echo "<h2>✅ Update Gambar Futsal - Progress</h2>";
echo "<hr>";
echo "<p style='color: #666; font-size: 14px;'>Mengupdate semua gambar lapangan dengan futsal berkualitas tinggi dari Unsplash...</p>";
echo "<hr>";

$index = 0;
$successCount = 0;
$errorCount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $nama = $row['namaLapangan'];
    
    // Ambil gambar (cycle through array)
    $gambar = $gambarFutsal[$index % count($gambarFutsal)];
    
    // Escape untuk security
    $gambarEsc = mysqli_real_escape_string($koneksi, $gambar);
    
    // Update database
    $updateQuery = "UPDATE lapangan SET gambar = '$gambarEsc' WHERE id = $id";
    
    if (mysqli_query($koneksi, $updateQuery)) {
        $successCount++;
        echo "<div style='color: green; padding: 5px; font-size: 14px;'>✓ ID $id - $nama</div>";
    } else {
        $errorCount++;
        echo "<div style='color: red; padding: 5px; font-size: 14px;'>✗ ID $id - ERROR: " . mysqli_error($koneksi) . "</div>";
    }
    
    $index++;
}

echo "<hr>";
echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; border: 1px solid #c3e6cb;'>";
echo "<h3 style='color: #155724; margin-top: 0;'>✅ UPDATE SELESAI!</h3>";
echo "<p><strong>✓ Berhasil diupdate:</strong> <span style='color: green; font-weight: bold;'>$successCount lapangan</span></p>";
echo "<p><strong>✗ Gagal:</strong> <span style='color: red; font-weight: bold;'>$errorCount lapangan</span></p>";
echo "<p><strong>Total:</strong> " . ($successCount + $errorCount) . " lapangan</p>";
echo "<p style='margin-bottom: 0; margin-top: 20px;'><strong>Catatan:</strong> Semua gambar sekarang menggunakan foto futsal/indoor soccer berkualitas tinggi dari Unsplash. Gambar akan loading otomatis saat halaman dibuka.</p>";
echo "</div>";
echo "<hr>";
echo "<p><a href='../Pages/LandingPage.php' style='padding: 12px 24px; background: #10b981; color: white; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;'>🏃 Lihat Landing Page dengan Gambar Baru</a></p>";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Gambar Futsal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        div {
            margin: 5px 0;
        }
        h2, h3 {
            color: #333;
        }
        a {
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
</body>
</html>
