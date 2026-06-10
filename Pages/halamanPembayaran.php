<?php
include '../server/koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get parameters from POST first
$id_lapangan = isset($_POST['id_lapangan']) ? intval($_POST['id_lapangan']) : 0;
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$jam = isset($_POST['jam']) ? $_POST['jam'] : '';
$selected_price = isset($_POST['selected_price']) ? intval($_POST['selected_price']) : 0;

// Fallback to session if parameters are not in POST
if ($id_lapangan === 0 && isset($_SESSION['checkout_pending'])) {
    $id_lapangan = intval($_SESSION['checkout_pending']['id_lapangan']);
    $tanggal = $_SESSION['checkout_pending']['tanggal'];
    $jam = $_SESSION['checkout_pending']['jam'];
    $selected_price = intval($_SESSION['checkout_pending']['selected_price']);
}

// Enforce customer login
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    // If guest attempts checkout, save pending details in session
    if ($id_lapangan > 0 && !empty($tanggal) && !empty($jam)) {
        $_SESSION['checkout_pending'] = [
            'id_lapangan' => $id_lapangan,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'selected_price' => $selected_price
        ];
    }
    header('Location: ../login/login2.php?error=' . urlencode('Silakan login sebagai Pelanggan terlebih dahulu untuk menyelesaikan pembayaran!'));
    exit();
}

// If logged in successfully, clear the pending session data
if (isset($_SESSION['checkout_pending'])) {
    unset($_SESSION['checkout_pending']);
}

// Redirect back if parameters are missing
if ($id_lapangan === 0 || empty($tanggal) || empty($jam)) {
    header("Location: LandingPage.php");
    exit();
}

// Fetch lapangan details
$query = "SELECT * FROM lapangan WHERE id = $id_lapangan";
$result = mysqli_query($koneksi, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $lap = mysqli_fetch_assoc($result);
} else {
    echo "Lapangan tidak ditemukan.";
    exit();
}

// Pre-fill user data if logged in
$is_logged_in = isset($_SESSION['nama']);
$user_name = '';
$user_email = '';

if ($is_logged_in) {
    $user_name = $_SESSION['nama'];
    $user_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Booking - Just Do Sport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-900 via-gray-900 to-black min-h-screen text-gray-100 flex flex-col justify-between">

    <!-- Navbar -->
    <div class="w-full">
        <?php include '../includes/Navbar.php'; ?>
    </div>

    <!-- Main Container -->
    <div class="container mx-auto px-4 md:px-8 max-w-6xl mt-24 mb-16 flex-grow">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-white tracking-tight">Detail Pemesanan & Pembayaran</h1>
            <p class="text-green-400 mt-2">Selesaikan pemesanan lapangan Anda dengan aman</p>
        </div>

        <form id="paymentForm" action="savePayment.php" method="POST">
            <!-- Hidden inputs -->
            <input type="hidden" name="id_lapangan" value="<?php echo $id_lapangan; ?>">
            <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
            <input type="hidden" name="jam" value="<?php echo htmlspecialchars($jam); ?>">
            <input type="hidden" name="harga" value="<?php echo $selected_price; ?>">
            <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" value="">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left: Field Details & Customer Details -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Field Summary Card -->
                    <div class="bg-white text-gray-800 rounded-3xl p-6 shadow-xl flex flex-col sm:flex-row gap-6 items-center">
                        <img src="<?php echo $lap['gambar']; ?>" alt="Lapangan" class="w-full sm:w-48 h-36 object-cover rounded-2xl shadow">
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-950"><?php echo htmlspecialchars($lap['namaLapangan']); ?></h3>
                            <p class="text-gray-600 text-sm mt-1 mb-3"><i class="fas fa-map-marker-alt text-green-600 mr-1"></i> <?php echo htmlspecialchars($lap['alamat']); ?></p>
                            <div class="grid grid-cols-2 gap-2 text-sm text-gray-700 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                <div>
                                    <span class="text-gray-400 block text-xs uppercase font-bold">Tanggal</span>
                                    <span class="font-bold"><?php echo date('d F Y', strtotime($tanggal)); ?></span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block text-xs uppercase font-bold">Jam</span>
                                    <span class="font-bold text-green-600"><?php echo htmlspecialchars($jam); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info Card -->
                    <div class="bg-white text-gray-800 rounded-3xl p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-950 flex items-center gap-2">
                                <i class="fas fa-user-circle text-green-600"></i>
                                <span>Detail Pelanggan</span>
                            </h3>
                            <?php if ($is_logged_in): ?>
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-200">
                                    <i class="fas fa-check-circle mr-1"></i>Akun Terhubung
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nama_kustomer" class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                                <input type="text" id="nama_kustomer" name="nama_kustomer" required value="<?php echo htmlspecialchars($user_name); ?>" <?php echo $is_logged_in ? 'readonly' : ''; ?>
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none <?php echo $is_logged_in ? 'opacity-80 cursor-not-allowed bg-gray-100' : ''; ?>">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-600 mb-1">Alamat Email</label>
                                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user_email); ?>" <?php echo $is_logged_in ? 'readonly' : ''; ?>
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none <?php echo $is_logged_in ? 'opacity-80 cursor-not-allowed bg-gray-100' : ''; ?>">
                            </div>
                            <div class="md:col-span-2">
                                <label for="no_telp" class="block text-sm font-semibold text-gray-600 mb-1">Nomor WhatsApp / HP</label>
                                <input type="text" id="no_telp" name="no_telp" required placeholder="Contoh: 08123456789"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label for="keterangan" class="block text-sm font-semibold text-gray-600 mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea id="keterangan" name="keterangan" rows="3" placeholder="Tulis catatan jika ada..."
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all outline-none resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right: Payment Methods & Pricing Summary -->
                <div class="space-y-6">
                    
                    <!-- Payment Choice Card -->
                    <div class="bg-white text-gray-800 rounded-3xl p-6 shadow-xl">
                        <h3 class="text-xl font-bold text-gray-950 mb-2 flex items-center gap-2">
                            <i class="fas fa-credit-card text-green-600"></i>
                            <span>Metode Pembayaran</span>
                        </h3>
                        <p class="text-xs text-gray-400 mb-6">Pilih salah satu metode pembayaran di bawah ini</p>
                        
                        <div class="space-y-6">
                            
                            <!-- QRIS / E-Wallet -->
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">QRIS / E-Wallet</h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="QRIS">
                                        <img src="../assets/qris.png" alt="QRIS" class="h-6 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='QRIS';">
                                    </button>
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="DANA">
                                        <img src="../assets/dana.png" alt="DANA" class="h-6 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='DANA';">
                                    </button>
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="GoPay">
                                        <img src="../assets/gopay.png" alt="GoPay" class="h-5 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='GoPay';">
                                    </button>
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="OVO">
                                        <img src="../assets/ovo.jpeg" alt="OVO" class="h-6 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='OVO';">
                                    </button>
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all col-span-2" data-value="ShopeePay">
                                        <img src="../assets/shopee.png" alt="ShopeePay" class="h-6 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='ShopeePay';">
                                    </button>
                                </div>
                            </div>

                            <!-- Transfer Bank / VA -->
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">Virtual Account (VA)</h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="BCA VA">
                                        <img src="../assets/bca.jpeg" alt="BCA" class="h-6 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='BCA VA';">
                                    </button>
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="BNI VA">
                                        <img src="../assets/bni.png" alt="BNI" class="h-6 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='BNI VA';">
                                    </button>
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="BRI VA">
                                        <img src="../assets/bri.png" alt="BRI" class="h-6 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='BRI VA';">
                                    </button>
                                    <button type="button" class="pay-method-btn border border-gray-200 hover:border-green-500 hover:bg-green-50 rounded-xl p-3 flex justify-center items-center h-12 transition-all" data-value="Mandiri VA">
                                        <img src="../assets/mandiri.png" alt="Mandiri" class="h-4 object-contain" onerror="this.src='https://ayo.co.id/assets/icon/grass.png'; this.parentNode.innerHTML='Mandiri VA';">
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Pricing Summary Card -->
                    <div class="bg-gray-900 text-white rounded-3xl p-6 shadow-xl border border-gray-800">
                        <h3 class="text-lg font-bold mb-4">Rincian Pembayaran</h3>
                        <div class="space-y-3 text-sm border-b border-gray-800 pb-4 mb-4">
                            <div class="flex justify-between text-gray-400">
                                <span>Harga Lapangan</span>
                                <span>Rp <?php echo number_format($selected_price, 0, ',', '.'); ?></span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Biaya Layanan</span>
                                <span>Rp 5.000</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-6">
                            <span class="font-bold text-base">Total Bayar</span>
                            <span class="font-extrabold text-2xl text-green-400">Rp <?php echo number_format($selected_price + 5000, 0, ',', '.'); ?></span>
                        </div>
                        <button type="submit" id="submitBtn" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-xl transition duration-300 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2" disabled>
                            <i class="fas fa-lock"></i>
                            <span>Selesaikan Pembayaran</span>
                        </button>
                    </div>

                </div>

            </div>
        </form>

    </div>

    <!-- Footer -->
    <div class="w-full">
        <?php include '../includes/Footer.php'; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payButtons = document.querySelectorAll('.pay-method-btn');
            const methodInput = document.getElementById('metode_pembayaran');
            const submitBtn = document.getElementById('submitBtn');
            let selectedButton = null;

            payButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Reset previous button highlight
                    if (selectedButton) {
                        selectedButton.classList.remove('border-green-600', 'bg-green-50', 'ring-2', 'ring-green-500');
                        selectedButton.classList.add('border-gray-200');
                    }

                    // Apply new highlight
                    button.classList.remove('border-gray-200');
                    button.classList.add('border-green-600', 'bg-green-50', 'ring-2', 'ring-green-500');

                    selectedButton = button;
                    const val = button.getAttribute('data-value');
                    methodInput.value = val;
                    
                    // Enable submit button
                    submitBtn.removeAttribute('disabled');
                });
            });
        });
    </script>
</body>
</html>