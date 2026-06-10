<?php
session_start();
include '../server/koneksi.php';

// Validate owner session
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    header('Location: ../login/login2.php?error=' . urlencode('Silakan login sebagai Pemilik Lapangan terlebih dahulu!'));
    exit();
}

$id_pemilik = intval($_SESSION['user_id']);
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$query = "SELECT * FROM lapangan WHERE id = $id AND id_pemilik = $id_pemilik";
$result = mysqli_query($koneksi, $query);
$lapangan = mysqli_fetch_assoc($result);

if (!$lapangan) {
    header('Location: index.php?error=Lapangan%20tidak%20ditemukan%20atau%20bukan%20milik%20Anda');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit Lapangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-gradient-to-r from-green-600 to-green-800 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">Just Do Sport - Admin Panel</h1>
            <a href="index.php" class="text-white hover:text-gray-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </nav>

    <div class="container mx-auto p-6 max-w-2xl">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Lapangan</h2>

            <form action="proses.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?php echo $lapangan['id']; ?>">

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Lapangan*</label>
                    <input type="text" name="namaLapangan" value="<?php echo $lapangan['namaLapangan']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Harga (per jam)*</label>
                    <input type="number" name="harga" value="<?php echo $lapangan['harga']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Alamat*</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required><?php echo $lapangan['alamat']; ?></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fasilitas*</label>
                    <input type="text" name="fasilitas" value="<?php echo $lapangan['fasilitas']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kontak Lapangan*</label>
                    <input type="text" name="kontakLapangan" value="<?php echo $lapangan['kontakLapangan']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">URL Gambar*</label>
                    <input type="url" name="gambar" value="<?php echo $lapangan['gambar']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <?php if ($lapangan['gambar']): ?>
                        <div class="mt-3">
                            <img src="<?php echo $lapangan['gambar']; ?>" alt="Preview" class="max-w-xs h-auto rounded">
                        </div>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Deskripsi Lapangan*</label>
                    <textarea name="ketlapangan" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required><?php echo $lapangan['ketlapangan']; ?></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-bold">
                        <i class="fas fa-save mr-2"></i>Perbarui Lapangan
                    </button>
                    <a href="index.php" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition font-bold text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
