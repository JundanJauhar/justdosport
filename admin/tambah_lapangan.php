<?php
session_start();
include '../server/koneksi.php';

// Validate owner session
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    header('Location: ../login/login2.php?error=' . urlencode('Silakan login sebagai Pemilik Lapangan terlebih dahulu!'));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Lapangan</title>
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
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Tambah Lapangan Baru</h2>

            <form action="proses.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="action" value="tambah">

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Lapangan*</label>
                    <input type="text" name="namaLapangan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Harga (per jam)*</label>
                    <input type="number" name="harga" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Alamat*</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fasilitas (pisahkan dengan koma)*</label>
                    <input type="text" name="fasilitas" placeholder="Contoh: Parkir, Kamar Mandi, Musholla" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kontak Lapangan*</label>
                    <input type="text" name="kontakLapangan" placeholder="Contoh: 08123456789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">URL Gambar*</label>
                    <input type="url" name="gambar" placeholder="Contoh: https://images.unsplash.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <p class="text-sm text-gray-500 mt-2">Gunakan gambar dari Unsplash, Pexels, atau URL gambar lain</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Deskripsi Lapangan*</label>
                    <textarea name="ketlapangan" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-bold">
                        <i class="fas fa-save mr-2"></i>Simpan Lapangan
                    </button>
                    <a href="index.php" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition font-bold text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>

            <div class="mt-8 p-4 bg-blue-50 border-l-4 border-blue-500">
                <p class="text-blue-700"><strong>Tips:</strong> Gunakan gambar dengan ukuran minimal 800x600px untuk hasil terbaik. Anda bisa mencari gambar futsal gratis di Unsplash atau Pexels.</p>
            </div>
        </div>
    </div>
</body>
</html>
