<?php
include '../server/koneksi.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id === 0) {
    header("Location: LandingPage.php");
    exit();
}

// Simulasi Bayar Lunas
if (isset($_GET['simulasi_bayar']) && $_GET['simulasi_bayar'] == '1') {
    $update_query = "UPDATE pemesanan SET status_pembayaran = 'Lunas' WHERE id = $order_id";
    mysqli_query($koneksi, $update_query);

    // Insert payment notification for the owner
    $field_query = mysqli_query($koneksi, "SELECT l.id_pemilik, l.namaLapangan, p.no_transaksi, p.nama_kustomer FROM pemesanan p JOIN lapangan l ON p.id_lapangan = l.id WHERE p.id = $order_id");
    if ($field_query && $field_row = mysqli_fetch_assoc($field_query)) {
        $id_pemilik = intval($field_row['id_pemilik']);
        $nama_lap = mysqli_real_escape_string($koneksi, $field_row['namaLapangan']);
        $no_tx = mysqli_real_escape_string($koneksi, $field_row['no_transaksi']);
        $nama_cust = mysqli_real_escape_string($koneksi, $field_row['nama_kustomer']);
        
        if ($id_pemilik > 0) {
            $notif_pesan = "Pembayaran <strong>Lunas</strong> diterima untuk transaksi <strong>$no_tx</strong> oleh <strong>$nama_cust</strong> ($nama_lap).";
            mysqli_query($koneksi, "INSERT INTO notifikasi (id_pemilik, pesan) VALUES ($id_pemilik, '$notif_pesan')");
        }
    }

    header("Location: hasilPembayaran.php?order_id=" . $order_id . "&success_status=1");
    exit();
}

// Fetch pemesanan
$query = "SELECT p.*, l.namaLapangan, l.alamat, l.gambar FROM pemesanan p 
          JOIN lapangan l ON p.id_lapangan = l.id 
          WHERE p.id = $order_id";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $order = mysqli_fetch_assoc($result);
} else {
    echo "Pemesanan tidak ditemukan.";
    exit();
}

// Generate virtual account number based on phone number for bank transfer
$va_number = '8808' . preg_replace('/[^0-9]/', '', $order['no_telp']);
if (strlen($va_number) < 12) {
    $va_number .= rand(1000, 9999);
}

// Payment method display properties
$is_qris = in_array($order['metode_pembayaran'], ['QRIS', 'DANA', 'GoPay', 'OVO', 'ShopeePay']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran - Just Do Sport</title>
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
    <div class="container mx-auto px-4 md:px-8 max-w-5xl mt-24 mb-16 flex-grow">
        
        <?php if (isset($_GET['success_status'])): ?>
            <div class="bg-green-600 text-white rounded-2xl p-4 mb-6 shadow-lg flex items-center gap-3">
                <i class="fas fa-check-circle text-2xl"></i>
                <div>
                    <strong class="block">Pembayaran Berhasil Disimulasikan!</strong>
                    <span class="text-sm">Status pesanan Anda telah diupdate menjadi Lunas. Lapangan ini sekarang telah ter-booking.</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="bg-white text-gray-800 rounded-3xl shadow-2xl p-6 md:p-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Left: Order Details & Customer Info -->
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-4">
                        <h2 class="text-2xl font-extrabold text-gray-950 flex items-center gap-2">
                            <i class="fas fa-receipt text-green-600"></i>
                            <span>Detail Pemesanan</span>
                        </h2>
                    </div>

                    <div class="grid grid-cols-3 gap-y-3 gap-x-2 text-sm text-gray-700">
                        <div class="text-gray-400 font-semibold uppercase text-xs">Lapangan</div>
                        <div class="col-span-2 font-bold text-gray-900">: <?php echo htmlspecialchars($order['namaLapangan']); ?></div>

                        <div class="text-gray-400 font-semibold uppercase text-xs">Tanggal Main</div>
                        <div class="col-span-2 font-bold text-gray-900">: <?php echo date('d F Y', strtotime($order['tanggal'])); ?></div>

                        <div class="text-gray-400 font-semibold uppercase text-xs">Jam Main</div>
                        <div class="col-span-2 font-bold text-green-600">: <?php echo htmlspecialchars($order['jam']); ?></div>

                        <div class="text-gray-400 font-semibold uppercase text-xs">No. Transaksi</div>
                        <div class="col-span-2 font-bold text-gray-900">: <?php echo htmlspecialchars($order['no_transaksi']); ?></div>

                        <div class="text-gray-400 font-semibold uppercase text-xs">Nama Kustomer</div>
                        <div class="col-span-2 font-bold text-gray-900">: <?php echo htmlspecialchars($order['nama_kustomer']); ?></div>

                        <div class="text-gray-400 font-semibold uppercase text-xs">Nomor WA</div>
                        <div class="col-span-2 font-bold text-gray-900">: <?php echo htmlspecialchars($order['no_telp']); ?></div>

                        <div class="text-gray-400 font-semibold uppercase text-xs">Email</div>
                        <div class="col-span-2 font-bold text-gray-900">: <?php echo htmlspecialchars($order['email']); ?></div>

                        <div class="text-gray-400 font-semibold uppercase text-xs">Catatan</div>
                        <div class="col-span-2 font-bold text-gray-900">: <?php echo empty($order['keterangan']) ? '-' : htmlspecialchars($order['keterangan']); ?></div>
                    </div>

                    <!-- Payment Status Badge -->
                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-semibold text-gray-500">Status Pembayaran</span>
                            <?php if ($order['status_pembayaran'] === 'Lunas'): ?>
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-200">LUNAS</span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full border border-red-200">BELUM DIBAYAR</span>
                            <?php endif; ?>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-semibold text-gray-500">Metode Pembayaran</span>
                            <span class="font-bold text-gray-800 flex items-center gap-1">
                                <i class="fas fa-credit-card text-green-600 text-xs"></i>
                                <?php echo htmlspecialchars($order['metode_pembayaran']); ?>
                            </span>
                        </div>
                        <div class="flex justify-between items-center border-t border-gray-200 mt-3 pt-3">
                            <span class="font-bold text-gray-900">Total Pembayaran</span>
                            <span class="font-extrabold text-xl text-red-600">Rp <?php echo number_format($order['harga'] + 5000, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Interactive Payment Instructions -->
                <div class="bg-gray-50 rounded-3xl p-6 border border-gray-200 flex flex-col justify-between">
                    <div>
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <h3 class="text-xl font-bold text-gray-950 flex items-center gap-2">
                                <i class="fas fa-info-circle text-green-600"></i>
                                <span>Instruksi Pembayaran</span>
                            </h3>
                        </div>

                        <?php if ($order['status_pembayaran'] === 'Lunas'): ?>
                            <!-- Paid View -->
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 border border-green-200">
                                    <i class="fas fa-check text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900">Pembayaran Selesai!</h4>
                                <p class="text-sm text-gray-500 mt-2 px-6">Terima kasih atas pembayaran Anda. Silakan tunjukkan halaman invoice ini kepada petugas lapangan pada saat bermain.</p>
                            </div>
                        <?php else: ?>
                            <!-- Unpaid View -->
                            <?php if ($is_qris): ?>
                                <!-- QRIS scan layout -->
                                <div class="text-center space-y-4">
                                    <p class="text-sm text-gray-600">Scan QRIS di bawah ini menggunakan aplikasi e-wallet Anda (DANA, OVO, GoPay, LinkAja, BCA Mobile, dll.)</p>
                                    <div class="bg-white p-3 rounded-2xl border inline-block shadow-sm">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=JustDoSport-Order-<?php echo $order_id; ?>" alt="QRIS Code" class="w-48 h-48 mx-auto">
                                    </div>
                                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Expired dalam 15 menit</p>
                                </div>
                            <?php else: ?>
                                <!-- Bank Transfer / Virtual Account layout -->
                                <div class="space-y-4">
                                    <p class="text-sm text-gray-600">Silakan lakukan transfer Virtual Account ke nomor rekening di bawah ini:</p>
                                    
                                    <div class="bg-white p-4 rounded-xl border border-gray-200">
                                        <div class="flex justify-between items-center text-xs text-gray-400 font-bold uppercase mb-1">
                                            <span>Bank Penerima</span>
                                            <span><?php echo htmlspecialchars($order['metode_pembayaran']); ?></span>
                                        </div>
                                        <div class="text-lg font-extrabold text-gray-800">
                                            Just Do Sport
                                        </div>
                                    </div>

                                    <div class="bg-white p-4 rounded-xl border border-gray-200 flex justify-between items-center">
                                        <div>
                                            <span class="text-xs text-gray-400 font-bold uppercase block">Nomor Virtual Account</span>
                                            <span id="vaNumberText" class="text-xl font-mono font-bold text-green-600"><?php echo $va_number; ?></span>
                                        </div>
                                        <button onclick="copyVA()" class="bg-green-50 hover:bg-green-100 text-green-600 text-xs font-bold px-3 py-2 rounded-lg border border-green-200 transition flex items-center gap-1">
                                            <i class="far fa-copy"></i>
                                            <span>Salin</span>
                                        </button>
                                    </div>

                                    <div class="text-xs text-gray-400 space-y-1">
                                        <p class="font-semibold text-gray-500">Petunjuk Pembayaran:</p>
                                        <p>1. Gunakan M-Banking atau ATM pilihan Anda.</p>
                                        <p>2. Pilih menu Transfer -> Virtual Account.</p>
                                        <p>3. Masukkan nomor Virtual Account di atas.</p>
                                        <p>4. Pastikan nominal transfer sesuai dengan tagihan.</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <?php if ($order['status_pembayaran'] !== 'Lunas'): ?>
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <a href="hasilPembayaran.php?order_id=<?php echo $order_id; ?>&simulasi_bayar=1" 
                               class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl transition duration-300 shadow-md flex items-center justify-center gap-2">
                                <i class="fas fa-magic"></i>
                                <span>Simulasi Bayar Lunas (Testing)</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="w-full">
        <?php include '../includes/Footer.php'; ?>
    </div>

    <script>
        function copyVA() {
            const vaText = document.getElementById('vaNumberText').innerText;
            navigator.clipboard.writeText(vaText).then(function() {
                alert('Nomor Virtual Account berhasil disalin!');
            }, function(err) {
                console.error('Gagal menyalin text: ', err);
            });
        }
    </script>
</body>
</html>
