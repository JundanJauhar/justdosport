<?php
include "../server/koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in or not customer
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../login/login2.php?error=" . urlencode("Silakan login sebagai Pelanggan terlebih dahulu!"));
    exit();
}

$email_user = $_SESSION['email'];
$nama_user = $_SESSION['nama'];

// Query my bookings
$query = "SELECT p.*, l.namaLapangan, l.gambar, l.id as id_lapangan FROM pemesanan p 
          JOIN lapangan l ON p.id_lapangan = l.id 
          WHERE p.email = '$email_user' OR p.nama_kustomer = '$nama_user'
          ORDER BY p.id DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Just Do Sport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .star-rating button {
            color: #d1d5db; /* gray-300 */
            transition: color 0.15s ease-in-out;
        }
        .star-rating button.active {
            color: #fbbf24; /* yellow-400 */
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-900 via-gray-900 to-black min-h-screen text-gray-100 flex flex-col justify-between">

    <!-- Navbar -->
    <div class="w-full">
        <?php include '../includes/Navbar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 md:px-8 max-w-5xl mt-24 mb-16 flex-grow">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-white tracking-tight">Riwayat Pemesanan Saya</h1>
            <p class="text-green-400 mt-2">Daftar booking lapangan futsal yang telah Anda lakukan</p>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-600 text-white rounded-2xl p-4 mb-6 shadow-lg flex items-center gap-3">
                <i class="fas fa-check-circle text-2xl"></i>
                <span><?php echo htmlspecialchars($_GET['success']); ?></span>
            </div>
        <?php endif; ?>

        <?php if (mysqli_num_rows($result) === 0): ?>
            <div class="bg-white text-gray-800 rounded-3xl p-12 text-center shadow-2xl max-w-md mx-auto">
                <div class="text-gray-300 text-6xl mb-4"><i class="fas fa-calendar-times"></i></div>
                <h3 class="text-xl font-bold mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-500 mb-6 text-sm">Anda belum melakukan pemesanan lapangan apapun saat ini.</p>
                <a href="LandingPage.php" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-xl transition shadow">Cari Lapangan Sekarang</a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php while ($row = mysqli_fetch_assoc($result)): 
                    $is_lunas = $row['status_pembayaran'] === 'Lunas';
                    $is_batal = $row['status_pembayaran'] === 'Batal';
                    
                    // Check if already reviewed
                    $rev_check = mysqli_query($koneksi, "SELECT rating, komentar FROM ulasan WHERE id_lapangan = {$row['id_lapangan']} AND nama_kustomer = '$nama_user'");
                    $has_review = ($rev_check && mysqli_num_rows($rev_check) > 0);
                    $review_data = $has_review ? mysqli_fetch_assoc($rev_check) : null;
                ?>
                    <div class="bg-white text-gray-800 rounded-3xl p-6 shadow-xl flex flex-col md:flex-row gap-6 items-center border border-gray-100">
                        <img src="<?php echo $row['gambar']; ?>" alt="Court" class="w-full md:w-48 h-32 object-cover rounded-2xl shadow">
                        
                        <div class="flex-grow w-full">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <h3 class="text-xl font-bold text-gray-950"><?php echo htmlspecialchars($row['namaLapangan']); ?></h3>
                                <span class="text-xs font-mono bg-gray-100 text-gray-500 px-3 py-1 rounded-full font-semibold border"><?php echo htmlspecialchars($row['no_transaksi']); ?></span>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs mt-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <div>
                                    <span class="text-gray-400 block font-bold uppercase mb-0.5">Tanggal Main</span>
                                    <span class="font-bold text-gray-800"><?php echo date('d F Y', strtotime($row['tanggal'])); ?></span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block font-bold uppercase mb-0.5">Jam Main</span>
                                    <span class="font-bold text-green-600"><?php echo htmlspecialchars($row['jam']); ?></span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block font-bold uppercase mb-0.5">Total Harga</span>
                                    <span class="font-bold text-red-600">Rp <?php echo number_format($row['harga'] + 5000, 0, ',', '.'); ?></span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block font-bold uppercase mb-0.5">Metode Bayar</span>
                                    <span class="font-bold text-gray-800"><?php echo htmlspecialchars($row['metode_pembayaran']); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 w-full md:w-auto shrink-0 justify-center items-stretch sm:items-end">
                            <!-- Payment Status Badge -->
                            <div class="text-center">
                                <?php if ($is_lunas): ?>
                                    <span class="bg-green-100 text-green-700 text-xs font-bold px-4 py-1.5 rounded-full border border-green-200 block uppercase">Lunas</span>
                                <?php elseif ($is_batal): ?>
                                    <span class="bg-red-100 text-red-700 text-xs font-bold px-4 py-1.5 rounded-full border border-red-200 block uppercase">Batal</span>
                                <?php else: ?>
                                    <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-4 py-1.5 rounded-full border border-yellow-200 block uppercase">Belum Lunas</span>
                                <?php endif; ?>
                            </div>

                            <!-- Action button: Review / Invoice Link -->
                            <div class="mt-2 space-y-2">
                                <a href="hasilPembayaran.php?order_id=<?php echo $row['id']; ?>" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-xl text-xs transition block text-center border">
                                    <i class="fas fa-file-invoice mr-1"></i> Invoice
                                </a>
                                
                                <?php if ($is_lunas): ?>
                                    <?php if ($has_review): ?>
                                        <div class="bg-yellow-50 text-yellow-700 text-xs border border-yellow-200 p-2 rounded-xl text-center">
                                            <div class="flex justify-center text-[10px] mb-0.5">
                                                <?php for($i=1; $i<=5; $i++): ?>
                                                    <i class="fas fa-star <?php echo $i <= $review_data['rating'] ? 'text-amber-500' : 'text-gray-200'; ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <span class="font-bold">Ulasan Diberikan</span>
                                        </div>
                                    <?php else: ?>
                                        <button onclick="openReviewModal(<?php echo $row['id_lapangan']; ?>, '<?php echo htmlspecialchars($row['namaLapangan']); ?>')" 
                                                class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-xl text-xs transition flex items-center justify-center gap-1 shadow-md shadow-amber-100">
                                            <i class="far fa-star"></i>
                                            <span>Beri Ulasan</span>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white text-gray-800 rounded-3xl p-6 max-w-md w-full shadow-2xl animate-fade-in relative">
            <button onclick="closeReviewModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl">
                <i class="fas fa-times"></i>
            </button>
            
            <h3 class="text-2xl font-bold mb-1 text-gray-950">Beri Ulasan Lapangan</h3>
            <p id="modalCourtName" class="text-sm text-green-600 font-bold mb-6">Jakal 7 Futsal</p>
            
            <form action="submitReview.php" method="POST" class="space-y-4">
                <input type="hidden" name="id_lapangan" id="modalFieldId" value="">
                
                <!-- Rating Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">Beri Bintang (1 - 5)*</label>
                    <div class="flex gap-2 star-rating text-2xl" id="starContainer">
                        <button type="button" onclick="setRating(1)" class="focus:outline-none"><i class="fas fa-star"></i></button>
                        <button type="button" onclick="setRating(2)" class="focus:outline-none"><i class="fas fa-star"></i></button>
                        <button type="button" onclick="setRating(3)" class="focus:outline-none"><i class="fas fa-star"></i></button>
                        <button type="button" onclick="setRating(4)" class="focus:outline-none"><i class="fas fa-star"></i></button>
                        <button type="button" onclick="setRating(5)" class="focus:outline-none"><i class="fas fa-star"></i></button>
                    </div>
                    <input type="hidden" name="rating" id="selectedRatingInput" value="5" required>
                </div>

                <!-- Comment input -->
                <div>
                    <label for="komentar" class="block text-sm font-semibold text-gray-600 mb-1">Komentar / Ulasan Anda*</label>
                    <textarea id="komentar" name="komentar" rows="4" required placeholder="Tulis ulasan Anda terhadap kualitas lapangan..."
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none resize-none"></textarea>
                </div>

                <!-- Submit buttons -->
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition shadow flex items-center justify-center gap-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Ulasan</span>
                    </button>
                    <button type="button" onclick="closeReviewModal()" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl transition border text-center">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="w-full">
        <?php include '../includes/Footer.php'; ?>
    </div>

    <script>
        const modal = document.getElementById('reviewModal');
        const modalCourtName = document.getElementById('modalCourtName');
        const modalFieldId = document.getElementById('modalFieldId');
        const ratingInput = document.getElementById('selectedRatingInput');
        const starButtons = document.querySelectorAll('#starContainer button');

        function openReviewModal(fieldId, courtName) {
            modalFieldId.value = fieldId;
            modalCourtName.textContent = courtName;
            setRating(5); // Default to 5 stars
            modal.classList.remove('hidden');
        }

        function closeReviewModal() {
            modal.classList.add('hidden');
        }

        function setRating(val) {
            ratingInput.value = val;
            starButtons.forEach((btn, index) => {
                if (index < val) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>
