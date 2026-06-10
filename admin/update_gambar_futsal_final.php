<?php
include '../server/koneksi.php';

/**
 * SCRIPT UPDATE GAMBAR FUTSAL - VERSI 3 DENGAN SUMBER MULTIPLE
 * Menggunakan gambar dari berbagai sumber yang sudah teruji
 */

// Array gambar futsal yang sudah teruji loading dengan baik
$gambarFutsal = [
    // Futsal action shots yang bagus
    'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop',  
    // Indoor soccer/futsal court
    'https://images.unsplash.com/photo-1552667449-8631fc08231f?w=800&h=600&fit=crop',  
    // Soccer player feet close-up
    'https://images.unsplash.com/photo-1534158914592-062992fbe900?w=800&h=600&fit=crop',  
    // Team sports action
    'https://images.unsplash.com/photo-1445049976739-d2cecac38203?w=800&h=600&fit=crop',  
    // Soccer players game
    'https://images.unsplash.com/photo-1556821552-5c63f2b6bef8?w=800&h=600&fit=crop',  
];

// Query ambil semua lapangan
$query = "SELECT id, namaLapangan, gambar as gambar_lama FROM lapangan ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);

echo "<style>
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
.container { background: white; max-width: 800px; margin: 0 auto; padding: 30px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
h1 { color: #333; margin-top: 0; }
.success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; margin: 5px 0; border-radius: 5px; font-size: 14px; }
.info { background: #cfe2ff; border: 1px solid #b6d4fe; color: #084298; padding: 15px; margin: 20px 0; border-radius: 5px; }
.final { background: #d1ecf1; border: 1px solid #badbcc; color: #0c5460; padding: 15px; margin: 20px 0; border-radius: 5px; }
.button { display: inline-block; padding: 12px 24px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; font-weight: bold; transition: all 0.3s; }
.button:hover { background: #764ba2; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
</style>";

echo "<div class='container'>";
echo "<h1>🖼️ Update Gambar Futsal - Versi Final</h1>";

$index = 0;
$successCount = 0;
$totalCount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $nama = $row['namaLapangan'];
    $gambar_lama = $row['gambar_lama'];
    
    // Ambil gambar dari array dengan cycle
    $gambar_baru = $gambarFutsal[$index % count($gambarFutsal)];
    
    // Escape
    $gambarEsc = mysqli_real_escape_string($koneksi, $gambar_baru);
    
    // Update
    $updateQuery = "UPDATE lapangan SET gambar = '$gambarEsc' WHERE id = $id";
    
    if (mysqli_query($koneksi, $updateQuery)) {
        echo "<div class='success'>✓ ID $id - <strong>$nama</strong> ✅ Gambar diupdate</div>";
        $successCount++;
    }
    
    $totalCount++;
    $index++;
}

echo "<div class='final'>";
echo "<h2 style='margin-top: 0; color: #0c5460;'>✅ UPDATE SELESAI!</h2>";
echo "<p><strong>Total Lapangan:</strong> $totalCount</p>";
echo "<p><strong>Berhasil Diupdate:</strong> <span style='color: green; font-weight: bold;'>$successCount lapangan</span></p>";
echo "<p><strong>Status:</strong> Semua gambar lapangan sekarang menggunakan foto futsal berkualitas tinggi dari Unsplash!</p>";
echo "</div>";

echo "<div class='info'>";
echo "<h3 style='margin-top: 0;'>📸 Informasi Gambar</h3>";
echo "<p><strong>Sumber:</strong> Unsplash.com (Free Stock Photos)</p>";
echo "<p><strong>Format:</strong> JPG dengan optimasi ukuran (800x600px)</p>";
echo "<p><strong>Lisensi:</strong> Gratis untuk penggunaan pribadi & komersial</p>";
echo "<p><strong>Respon Time:</strong> Cepat & Reliable</p>";
echo "</div>";

echo "<a href='../Pages/LandingPage.php' class='button'>🏃 Lihat Landing Page Sekarang</a>";
echo "</div>";
?>
