<?php
session_start();
include '../server/koneksi.php';

// Validate owner session
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    header('Location: ../login/login2.php?error=' . urlencode('Silakan login sebagai Pemilik Lapangan terlebih dahulu!'));
    exit();
}

$id_pemilik = intval($_SESSION['user_id']);
$nama_owner = $_SESSION['nama'];

// Get active tab (default to 'lapangan')
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lapangan';

// Automatically mark notifications as read if visiting notifications tab
if ($active_tab === 'notif') {
    mysqli_query($koneksi, "UPDATE notifikasi SET is_read = 1 WHERE id_pemilik = $id_pemilik");
}

// Fetch owned fields
$query_lapangan = "SELECT * FROM lapangan WHERE id_pemilik = $id_pemilik ORDER BY id DESC";
$result_lapangan = mysqli_query($koneksi, $query_lapangan);

// Fetch bookings for owned fields
$query_pesanan = "SELECT p.*, l.namaLapangan FROM pemesanan p 
                  JOIN lapangan l ON p.id_lapangan = l.id 
                  WHERE l.id_pemilik = $id_pemilik 
                  ORDER BY p.id DESC";
$result_pesanan = mysqli_query($koneksi, $query_pesanan);

// Fetch notifications
$query_notif = "SELECT * FROM notifikasi WHERE id_pemilik = $id_pemilik ORDER BY id DESC LIMIT 50";
$result_notif = mysqli_query($koneksi, $query_notif);

// Count unread notifications
$query_unread = mysqli_query($koneksi, "SELECT COUNT(*) as unread FROM notifikasi WHERE id_pemilik = $id_pemilik AND is_read = 0");
$unread_row = mysqli_fetch_assoc($query_unread);
$unread_count = intval($unread_row['unread']);

// Fetch stats for analytics
$query_stats = mysqli_query($koneksi, "SELECT SUM(p.harga) as total_rev, COUNT(p.id) as total_bookings FROM pemesanan p
                                      JOIN lapangan l ON p.id_lapangan = l.id
                                      WHERE l.id_pemilik = $id_pemilik AND p.status_pembayaran = 'Lunas'");
$stats = mysqli_fetch_assoc($query_stats);
$total_revenue = intval($stats['total_rev']);
$total_bookings = intval($stats['total_bookings']);

// Fetch field count
$query_fields_count = mysqli_query($koneksi, "SELECT COUNT(*) as total_fields FROM lapangan WHERE id_pemilik = $id_pemilik");
$fields_count_row = mysqli_fetch_assoc($query_fields_count);
$total_fields = intval($fields_count_row['total_fields']);

// Fetch average rating
$query_avg_rating = mysqli_query($koneksi, "SELECT AVG(u.rating) as avg_rate FROM ulasan u
                                            JOIN lapangan l ON u.id_lapangan = l.id
                                            WHERE l.id_pemilik = $id_pemilik");
$avg_rating_row = mysqli_fetch_assoc($query_avg_rating);
$average_rating = $avg_rating_row['avg_rate'] ? round(floatval($avg_rating_row['avg_rate']), 1) : 0;

// Chart data: last 7 days revenue
$chart_labels = [];
$chart_data = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $chart_labels[] = date('d M', strtotime($date));
    
    $query_day = mysqli_query($koneksi, "SELECT SUM(p.harga) as day_total FROM pemesanan p
                                        JOIN lapangan l ON p.id_lapangan = l.id
                                        WHERE l.id_pemilik = $id_pemilik 
                                        AND p.status_pembayaran = 'Lunas' 
                                        AND p.tanggal = '$date'");
    $day_row = mysqli_fetch_assoc($query_day);
    $chart_data[] = intval($day_row['day_total']);
}

// Fetch reviews
$query_reviews = "SELECT u.*, l.namaLapangan FROM ulasan u 
                  JOIN lapangan l ON u.id_lapangan = l.id 
                  WHERE l.id_pemilik = $id_pemilik 
                  ORDER BY u.id DESC";
$result_reviews = mysqli_query($koneksi, $query_reviews);

// Fetch sentiment counts
$pos_count = 0;
$neg_count = 0;
$net_count = 0;
$query_sentiments = mysqli_query($koneksi, "SELECT u.analisis_sentimen, COUNT(*) as count FROM ulasan u 
                                             JOIN lapangan l ON u.id_lapangan = l.id 
                                             WHERE l.id_pemilik = $id_pemilik 
                                             GROUP BY u.analisis_sentimen");
if ($query_sentiments) {
    while ($row_sent = mysqli_fetch_assoc($query_sentiments)) {
        if ($row_sent['analisis_sentimen'] === 'Positif') $pos_count = intval($row_sent['count']);
        elseif ($row_sent['analisis_sentimen'] === 'Negatif') $neg_count = intval($row_sent['count']);
        elseif ($row_sent['analisis_sentimen'] === 'Netral') $net_count = intval($row_sent['count']);
    }
}
$total_reviews = $pos_count + $neg_count + $net_count;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - Just Do Sport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800 flex flex-col justify-between">

    <!-- Top Navigation Bar -->
    <nav class="bg-gradient-to-r from-green-700 via-green-600 to-emerald-800 p-4 shadow-lg text-white sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fas fa-chart-line text-2xl"></i>
                <h1 class="text-xl font-bold tracking-tight">Just Do Sport <span class="text-xs uppercase bg-green-800 px-2 py-1 rounded ml-1 font-semibold">Mitra Owner</span></h1>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm hidden sm:inline"><i class="far fa-user mr-1"></i> Owner: <strong><?php echo htmlspecialchars($nama_owner); ?></strong></span>
                <a href="../Pages/LandingPage.php" class="text-sm bg-white bg-opacity-10 hover:bg-opacity-20 px-3 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-home"></i> <span>Beranda</span>
                </a>
                <a href="../login/logout.php" class="text-sm bg-red-600 hover:bg-red-700 px-3 py-2 rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> <span>Keluar</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mx-auto p-4 md:p-8 flex-grow">
        
        <!-- Alerts -->
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
                <i class="fas fa-check-circle text-lg"></i>
                <span class="font-medium"><?php echo htmlspecialchars($_GET['success']); ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-lg"></i>
                <span class="font-medium"><?php echo htmlspecialchars($_GET['error']); ?></span>
            </div>
        <?php endif; ?>

        <!-- Dashboard Layout Grid -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            <!-- Tab Headers -->
            <div class="flex flex-wrap border-b border-gray-200 bg-gray-50">
                <a href="index.php?tab=lapangan" 
                   class="flex-1 sm:flex-none text-center px-5 py-4 font-bold text-sm tracking-wide border-b-2 flex items-center justify-center gap-2 transition-all <?php echo $active_tab === 'lapangan' ? 'border-green-600 text-green-600 bg-white' : 'border-transparent text-gray-500 hover:text-gray-800' ?>">
                    <i class="fas fa-futbol"></i>
                    <span>Lapangan Saya</span>
                </a>
                <a href="index.php?tab=pesanan" 
                   class="flex-1 sm:flex-none text-center px-5 py-4 font-bold text-sm tracking-wide border-b-2 flex items-center justify-center gap-2 transition-all <?php echo $active_tab === 'pesanan' ? 'border-green-600 text-green-600 bg-white' : 'border-transparent text-gray-500 hover:text-gray-800' ?>">
                    <i class="fas fa-receipt"></i>
                    <span>Pesanan Masuk</span>
                </a>
                <a href="index.php?tab=analitik" 
                   class="flex-1 sm:flex-none text-center px-5 py-4 font-bold text-sm tracking-wide border-b-2 flex items-center justify-center gap-2 transition-all <?php echo $active_tab === 'analitik' ? 'border-green-600 text-green-600 bg-white' : 'border-transparent text-gray-500 hover:text-gray-800' ?>">
                    <i class="fas fa-chart-pie"></i>
                    <span>Analitik</span>
                </a>
                <a href="index.php?tab=notif" 
                   class="flex-1 sm:flex-none text-center px-5 py-4 font-bold text-sm tracking-wide border-b-2 flex items-center justify-center gap-2 transition-all <?php echo $active_tab === 'notif' ? 'border-green-600 text-green-600 bg-white' : 'border-transparent text-gray-500 hover:text-gray-800' ?>">
                    <i class="fas fa-bell"></i>
                    <span>Notifikasi</span>
                    <?php if ($unread_count > 0): ?>
                        <span class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold ml-1"><?php echo $unread_count; ?></span>
                    <?php endif; ?>
                </a>
                <a href="index.php?tab=reviews" 
                   class="flex-1 sm:flex-none text-center px-5 py-4 font-bold text-sm tracking-wide border-b-2 flex items-center justify-center gap-2 transition-all <?php echo $active_tab === 'reviews' ? 'border-green-600 text-green-600 bg-white' : 'border-transparent text-gray-500 hover:text-gray-800' ?>">
                    <i class="fas fa-comment-dots text-xs"></i>
                    <span>Ulasan & AI</span>
                    <?php if ($total_reviews > 0): ?>
                        <span class="bg-blue-600 text-white text-[10px] px-2 py-0.5 rounded-full font-bold ml-1"><?php echo $total_reviews; ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                
                <?php if ($active_tab === 'lapangan'): ?>
                    <!-- Tab: Lapangan Saya -->
                    <div>
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Daftar Lapangan Futsal Anda</h2>
                                <p class="text-sm text-gray-500">Unggah dan kelola lapangan futsal yang Anda sewakan</p>
                            </div>
                            <a href="tambah_lapangan.php" class="bg-green-600 text-white px-5 py-3 rounded-xl hover:bg-green-700 transition flex items-center gap-2 font-bold shadow-md shadow-green-100">
                                <i class="fas fa-plus"></i>
                                <span>Tambah Lapangan</span>
                            </a>
                        </div>

                        <?php if (mysqli_num_rows($result_lapangan) === 0): ?>
                            <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                                <div class="text-gray-300 text-5xl mb-3"><i class="fas fa-futbol"></i></div>
                                <h4 class="text-lg font-bold text-gray-700">Belum Ada Lapangan</h4>
                                <p class="text-sm text-gray-400 mt-1">Silakan tambahkan lapangan pertama Anda dengan menekan tombol di atas.</p>
                            </div>
                        <?php else: ?>
                            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                                <table class="w-full border-collapse text-left">
                                    <thead>
                                        <tr class="bg-gray-100 border-b border-gray-200 text-gray-700 text-xs font-bold uppercase tracking-wider">
                                            <th class="p-4 w-16 text-center">No</th>
                                            <th class="p-4">Gambar</th>
                                            <th class="p-4">Nama Lapangan</th>
                                            <th class="p-4">Harga Sewa</th>
                                            <th class="p-4">Alamat</th>
                                            <th class="p-4">Kontak Lapangan</th>
                                            <th class="p-4 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                                        <?php 
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result_lapangan)): 
                                        ?>
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-4 text-center font-bold text-gray-800"><?php echo $no++; ?></td>
                                                <td class="p-4">
                                                    <img src="<?php echo $row['gambar']; ?>" alt="Preview" class="w-20 h-14 object-cover rounded-lg shadow-sm border border-gray-100">
                                                </td>
                                                <td class="p-4 font-bold text-gray-900"><?php echo htmlspecialchars($row['namaLapangan']); ?></td>
                                                <td class="p-4 font-semibold text-green-600">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>/jam</td>
                                                <td class="p-4 max-w-xs truncate"><?php echo htmlspecialchars($row['alamat']); ?></td>
                                                <td class="p-4 font-mono"><?php echo htmlspecialchars($row['kontakLapangan']); ?></td>
                                                <td class="p-4">
                                                    <div class="flex justify-center items-center gap-2">
                                                        <a href="edit_lapangan.php?id=<?php echo $row['id']; ?>" class="bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 px-3 py-2 rounded-lg transition-all flex items-center gap-1 font-semibold text-xs">
                                                            <i class="fas fa-edit"></i> <span>Edit</span>
                                                        </a>
                                                        <a href="proses.php?action=hapus&id=<?php echo $row['id']; ?>" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-2 rounded-lg transition-all flex items-center gap-1 font-semibold text-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus lapangan ini?')">
                                                            <i class="fas fa-trash"></i> <span>Hapus</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php elseif ($active_tab === 'pesanan'): ?>
                    <!-- Tab: Pesanan Masuk -->
                    <div>
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Pesanan Masuk</h2>
                            <p class="text-sm text-gray-500">Pantau dan kelola pemesanan kustomer untuk lapangan Anda</p>
                        </div>

                        <?php if (mysqli_num_rows($result_pesanan) === 0): ?>
                            <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                                <div class="text-gray-300 text-5xl mb-3"><i class="fas fa-receipt"></i></div>
                                <h4 class="text-lg font-bold text-gray-700">Belum Ada Pesanan</h4>
                                <p class="text-sm text-gray-400 mt-1">Daftar pemesanan kustomer akan muncul di sini.</p>
                            </div>
                        <?php else: ?>
                            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                                <table class="w-full border-collapse text-left">
                                    <thead>
                                        <tr class="bg-gray-100 border-b border-gray-200 text-gray-700 text-xs font-bold uppercase tracking-wider">
                                            <th class="p-4 w-12 text-center">No</th>
                                            <th class="p-4">No. Transaksi</th>
                                            <th class="p-4">Lapangan</th>
                                            <th class="p-4">Waktu Sewa</th>
                                            <th class="p-4">Data Kustomer</th>
                                            <th class="p-4">Total</th>
                                            <th class="p-4">Metode</th>
                                            <th class="p-4">Status</th>
                                            <th class="p-4 text-center">Aksi Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                                        <?php 
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result_pesanan)): 
                                            $is_lunas = $row['status_pembayaran'] === 'Lunas';
                                            $is_batal = $row['status_pembayaran'] === 'Batal';
                                        ?>
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-4 text-center font-bold text-gray-800"><?php echo $no++; ?></td>
                                                <td class="p-4 font-mono font-bold text-xs text-gray-900"><?php echo htmlspecialchars($row['no_transaksi']); ?></td>
                                                <td class="p-4 font-semibold text-gray-900"><?php echo htmlspecialchars($row['namaLapangan']); ?></td>
                                                <td class="p-4">
                                                    <div class="font-bold text-gray-900"><?php echo date('d F Y', strtotime($row['tanggal'])); ?></div>
                                                    <div class="text-xs text-green-600 font-semibold"><i class="far fa-clock mr-1"></i><?php echo htmlspecialchars($row['jam']); ?></div>
                                                </td>
                                                <td class="p-4 space-y-1">
                                                    <div class="font-bold text-gray-900"><?php echo htmlspecialchars($row['nama_kustomer']); ?></div>
                                                    <div class="text-xs text-gray-500 font-mono"><i class="fab fa-whatsapp mr-1 text-green-500"></i><?php echo htmlspecialchars($row['no_telp']); ?></div>
                                                    <div class="text-xs text-gray-400"><i class="far fa-envelope mr-1"></i><?php echo htmlspecialchars($row['email']); ?></div>
                                                    <?php if(!empty($row['keterangan'])): ?>
                                                        <div class="text-xs bg-gray-50 p-2 rounded border border-gray-100 italic">"<?php echo htmlspecialchars($row['keterangan']); ?>"</div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="p-4 font-bold text-red-600">Rp <?php echo number_format($row['harga'] + 5000, 0, ',', '.'); ?></td>
                                                <td class="p-4 text-xs font-semibold uppercase text-gray-500"><?php echo htmlspecialchars($row['metode_pembayaran']); ?></td>
                                                <td class="p-4">
                                                    <?php if ($is_lunas): ?>
                                                        <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full border border-green-200 uppercase">Lunas</span>
                                                    <?php elseif ($is_batal): ?>
                                                        <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded-full border border-red-200 uppercase">Batal</span>
                                                    <?php else: ?>
                                                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded-full border border-yellow-200 uppercase">Belum Lunas</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="p-4">
                                                    <div class="flex justify-center items-center gap-1.5">
                                                        <?php if (!$is_lunas): ?>
                                                            <a href="proses.php?action=status_pesanan&id_pesan=<?php echo $row['id']; ?>&status=Lunas" 
                                                               class="bg-green-50 hover:bg-green-100 text-green-600 border border-green-200 p-2 rounded-lg transition-all text-xs font-bold flex items-center gap-1"
                                                               title="Tandai Lunas">
                                                                <i class="fas fa-check"></i> <span>Lunas</span>
                                                            </a>
                                                        <?php endif; ?>
                                                        
                                                        <?php if (!$is_batal): ?>
                                                            <a href="proses.php?action=status_pesanan&id_pesan=<?php echo $row['id']; ?>&status=Batal" 
                                                               class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 p-2 rounded-lg transition-all text-xs font-bold flex items-center gap-1"
                                                               title="Batalkan Pesanan"
                                                               onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                                                <i class="fas fa-times"></i> <span>Batal</span>
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="proses.php?action=status_pesanan&id_pesan=<?php echo $row['id']; ?>&status=Belum Dibayar" 
                                                               class="bg-yellow-50 hover:bg-yellow-100 text-yellow-600 border border-yellow-200 p-2 rounded-lg transition-all text-xs font-bold flex items-center gap-1"
                                                               title="Aktifkan Kembali">
                                                                <i class="fas fa-undo"></i> <span>Aktifkan</span>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php elseif ($active_tab === 'analitik'): ?>
                    <!-- Tab: Analitik & Perkembangan Pembokingan -->
                    <div>
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Dashboard Analitik</h2>
                            <p class="text-sm text-gray-500">Analisis perkembangan dan performa bisnis persewaan lapangan Anda</p>
                        </div>

                        <!-- Metric Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border border-green-200 shadow-sm flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-green-600 text-white flex items-center justify-center text-xl shrink-0"><i class="fas fa-wallet font-bold"></i></div>
                                <div>
                                    <span class="text-xs font-semibold text-green-700 uppercase tracking-wider block">Total Pendapatan</span>
                                    <strong class="text-xl text-gray-900">Rp <?php echo number_format($total_revenue, 0, ',', '.'); ?></strong>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl border border-blue-200 shadow-sm flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xl shrink-0"><i class="fas fa-calendar-check"></i></div>
                                <div>
                                    <span class="text-xs font-semibold text-blue-700 uppercase tracking-wider block">Booking Berhasil</span>
                                    <strong class="text-xl text-gray-900"><?php echo $total_bookings; ?> Kali</strong>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl border border-purple-200 shadow-sm flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center text-xl shrink-0"><i class="fas fa-futbol"></i></div>
                                <div>
                                    <span class="text-xs font-semibold text-purple-700 uppercase tracking-wider block">Lapangan Aktif</span>
                                    <strong class="text-xl text-gray-900"><?php echo $total_fields; ?> Unit</strong>
                                </div>
                            </div>
                            <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-2xl border border-amber-200 shadow-sm flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center text-xl shrink-0"><i class="fas fa-star"></i></div>
                                <div>
                                    <span class="text-xs font-semibold text-amber-700 uppercase tracking-wider block">Rata-rata Rating</span>
                                    <strong class="text-xl text-gray-900"><?php echo $average_rating; ?> / 5.0</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Graph Chart.js -->
                        <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2"><i class="fas fa-chart-line text-green-600"></i> Grafik Pendapatan Harian (7 Hari Terakhir)</h3>
                            <div class="h-80 w-full">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>

                <?php elseif ($active_tab === 'notif'): ?>
                    <!-- Tab: Notifikasi -->
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Pemberitahuan</h2>
                                <p class="text-sm text-gray-500">Notifikasi terbaru seputar aktivitas pemesanan kustomer</p>
                            </div>
                            <?php if (mysqli_num_rows($result_notif) > 0): ?>
                                <a href="proses.php?action=clear_notif" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold px-4 py-2 border rounded-xl transition flex items-center gap-1">
                                    <i class="fas fa-check-double"></i>
                                    <span>Tandai Semua Telah Dibaca</span>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (mysqli_num_rows($result_notif) === 0): ?>
                            <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                                <div class="text-gray-300 text-5xl mb-3"><i class="fas fa-bell-slash"></i></div>
                                <h4 class="text-lg font-bold text-gray-700">Tidak Ada Notifikasi</h4>
                                <p class="text-sm text-gray-400 mt-1">Semua pemberitahuan aktivitas baru akan masuk di sini.</p>
                            </div>
                        <?php else: ?>
                            <div class="space-y-3">
                                <?php while ($notif = mysqli_fetch_assoc($result_notif)): 
                                    $is_unread = $notif['is_read'] == 0;
                                ?>
                                    <div class="p-4 rounded-xl border flex items-start gap-4 transition-all <?php echo $is_unread ? 'bg-green-50 border-green-200' : 'bg-white border-gray-200 opacity-80' ?>">
                                        <div class="w-10 h-10 rounded-full shrink-0 flex items-center justify-center text-sm <?php echo $is_unread ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-400' ?>">
                                            <i class="fas <?php echo $is_unread ? 'fa-bell' : 'fa-envelope-open' ?>"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <div class="text-sm text-gray-800 leading-relaxed"><?php echo $notif['pesan']; ?></div>
                                            <div class="text-xs text-gray-400 font-mono mt-1"><i class="far fa-clock mr-1"></i><?php echo date('d M Y - H:i', strtotime($notif['created_at'])); ?></div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php elseif ($active_tab === 'reviews'): ?>
                    <!-- Tab: Ulasan & Analisis Sentimen AI -->
                    <div>
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Ulasan & Rating Kustomer (Analisis AI)</h2>
                            <p class="text-sm text-gray-500">Lihat bintang dan klasifikasi sentimen respon kustomer terhadap lapangan Anda</p>
                        </div>

                        <!-- Sentiment Summary cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center shadow-sm">
                                <div class="text-green-600 text-3xl mb-2"><i class="far fa-smile-wink font-bold"></i></div>
                                <div class="text-2xl font-extrabold text-green-700"><?php echo $pos_count; ?></div>
                                <span class="text-sm font-semibold text-green-600">Respon Positif (AI)</span>
                            </div>
                            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center shadow-sm">
                                <div class="text-red-600 text-3xl mb-2"><i class="far fa-angry font-bold"></i></div>
                                <div class="text-2xl font-extrabold text-red-700"><?php echo $neg_count; ?></div>
                                <span class="text-sm font-semibold text-red-600">Respon Negatif (AI)</span>
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 text-center shadow-sm">
                                <div class="text-gray-500 text-3xl mb-2"><i class="far fa-meh font-bold"></i></div>
                                <div class="text-2xl font-extrabold text-gray-700"><?php echo $net_count; ?></div>
                                <span class="text-sm font-semibold text-gray-500">Respon Netral (AI)</span>
                            </div>
                        </div>

                        <!-- Review Table -->
                        <?php if (mysqli_num_rows($result_reviews) === 0): ?>
                            <div class="text-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                                <div class="text-gray-300 text-5xl mb-3"><i class="far fa-comments"></i></div>
                                <h4 class="text-lg font-bold text-gray-700">Belum Ada Ulasan</h4>
                                <p class="text-sm text-gray-400 mt-1">Ulasan dari kustomer yang bermain akan muncul di sini.</p>
                            </div>
                        <?php else: ?>
                            <div class="overflow-x-auto rounded-2xl border border-gray-200">
                                <table class="w-full border-collapse text-left">
                                    <thead>
                                        <tr class="bg-gray-100 border-b border-gray-200 text-gray-700 text-xs font-bold uppercase tracking-wider">
                                            <th class="p-4 w-12 text-center">No</th>
                                            <th class="p-4">Tanggal</th>
                                            <th class="p-4">Lapangan</th>
                                            <th class="p-4">Kustomer</th>
                                            <th class="p-4">Rating</th>
                                            <th class="p-4 w-1/3">Komentar</th>
                                            <th class="p-4 text-center">Analisis Sentimen AI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 text-sm text-gray-600">
                                        <?php 
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result_reviews)): 
                                            $sentiment = $row['analisis_sentimen'];
                                        ?>
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-4 text-center font-bold text-gray-800"><?php echo $no++; ?></td>
                                                <td class="p-4 text-xs font-mono"><?php echo date('d M Y - H:i', strtotime($row['created_at'])); ?></td>
                                                <td class="p-4 font-bold text-gray-900"><?php echo htmlspecialchars($row['namaLapangan']); ?></td>
                                                <td class="p-4 font-semibold text-gray-800"><?php echo htmlspecialchars($row['nama_kustomer']); ?></td>
                                                <td class="p-4">
                                                    <div class="flex text-amber-500 text-xs">
                                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                                            <i class="fas fa-star <?php echo $i <= $row['rating'] ? '' : 'text-gray-200'; ?>"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </td>
                                                <td class="p-4 italic text-gray-700">"<?php echo htmlspecialchars($row['komentar']); ?>"</td>
                                                <td class="p-4 text-center">
                                                    <?php if ($sentiment === 'Positif'): ?>
                                                        <span class="bg-green-100 text-green-700 text-xs font-extrabold px-3 py-1.5 rounded-full border border-green-200 uppercase flex items-center justify-center gap-1 w-28 mx-auto">
                                                            <i class="far fa-thumbs-up"></i> Positif
                                                        </span>
                                                    <?php elseif ($sentiment === 'Negatif'): ?>
                                                        <span class="bg-red-100 text-red-700 text-xs font-extrabold px-3 py-1.5 rounded-full border border-red-200 uppercase flex items-center justify-center gap-1 w-28 mx-auto">
                                                            <i class="far fa-thumbs-down"></i> Negatif
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="bg-gray-100 text-gray-500 text-xs font-extrabold px-3 py-1.5 rounded-full border border-gray-200 uppercase flex items-center justify-center gap-1 w-28 mx-auto">
                                                            <i class="far fa-meh"></i> Netral
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 border-t border-gray-800 text-center text-sm">
        <p>&copy; <?php echo date('Y'); ?> Just Do Sport - Area Mitra Pemilik Lapangan. All Rights Reserved.</p>
    </footer>

    <!-- ChartJS Script Integration -->
    <?php if ($active_tab === 'analitik'): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('revenueChart').getContext('2d');
                const labels = <?php echo json_encode($chart_labels); ?>;
                const data = <?php echo json_encode($chart_data); ?>;

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendapatan Bersih (Rp)',
                            data: data,
                            borderColor: 'rgba(5, 150, 105, 1)', // emerald-600
                            backgroundColor: 'rgba(5, 150, 105, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: 'rgba(5, 150, 105, 1)',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        if (value >= 1000) {
                                            return 'Rp ' + (value/1000) + 'k';
                                        }
                                        return 'Rp ' + value;
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            });
        </script>
    <?php endif; ?>
</body>
</html>
