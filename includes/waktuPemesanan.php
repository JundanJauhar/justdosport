<?php
include '../server/koneksi.php';

$id = 0;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} elseif (isset($_GET['idPilihan'])) {
    $id = intval($_GET['idPilihan']);
} elseif (isset($_GET['id_tempatFutsal'])) {
    $id = intval($_GET['id_tempatFutsal']);
}

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : (isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'));

if ($id > 0) {
    // Fetch lapangan details
    $query = "SELECT * FROM lapangan WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $lap = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='p-5 text-red-600 font-bold'>Lapangan tidak ditemukan.</div>";
        exit();
    }
} else {
    echo "<div class='p-5 text-red-600 font-bold'>ID Lapangan tidak ditentukan.</div>";
    exit();
}

// Fetch already booked slots for this date and field
$booked_slots = [];
$query_booked = mysqli_query($koneksi, "SELECT jam FROM pemesanan WHERE id_lapangan = $id AND tanggal = '$tanggal' AND status_pembayaran != 'Batal'");
if ($query_booked) {
    while ($b = mysqli_fetch_assoc($query_booked)) {
        $booked_slots[] = $b['jam'];
    }
}

// Define available slots
$slots = [
    '08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00',
    '12:00 - 13:00', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',
    '16:00 - 17:00', '17:00 - 18:00', '18:00 - 19:00', '19:00 - 20:00',
    '20:00 - 21:00', '21:00 - 22:00'
];

$harga_lapangan = $lap['harga'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-transparent">
    <div class="mt-4 bg-white rounded-3xl p-5 shadow-inner">
        <div class="flex flex-col lg:flex-row justify-between items-start gap-8">
            
            <!-- Court info card -->
            <div class="w-full lg:w-2/5 bg-gray-50 rounded-2xl p-4 border border-gray-200">
                <img src="<?php echo $lap['gambar']; ?>" alt="Court Image" class="w-full h-48 object-cover rounded-xl mb-4 shadow">
                <h3 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($lap['namaLapangan']); ?></h3>
                <p class="text-sm text-gray-600 mb-4 flex items-start gap-2">
                    <i class="fas fa-map-marker-alt text-green-600 mt-1"></i>
                    <span><?php echo htmlspecialchars($lap['alamat']); ?></span>
                </p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <?php 
                    $facilities = json_decode($lap['fasilitas'], true);
                    if (!is_array($facilities)) {
                        $facilities = explode(',', $lap['fasilitas']);
                    }
                    foreach ($facilities as $facility): 
                        if(empty(trim($facility))) continue;
                    ?>
                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-semibold border border-green-200">
                            <?php echo htmlspecialchars(trim($facility, '[]" ')); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Slots Grid -->
            <div class="w-full lg:w-3/5">
                <h4 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <i class="far fa-clock text-green-600"></i>
                    <span>Pilih Jam Main (<?php echo date('d F Y', strtotime($tanggal)); ?>)</span>
                </h4>
                
                <form id="bookingForm" action="halamanPembayaran.php" method="POST">
                    <input type="hidden" name="id_lapangan" value="<?php echo $id; ?>">
                    <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
                    <input type="hidden" name="jam" id="selected_jam" value="">
                    <input type="hidden" name="selected_price" id="selected_price" value="0">
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <?php foreach ($slots as $slot): 
                            $is_booked = in_array($slot, $booked_slots);
                            if ($is_booked):
                        ?>
                            <!-- Booked Slot -->
                            <button type="button" class="bg-red-500 text-white rounded-xl p-3 h-[60px] cursor-not-allowed w-full flex flex-col justify-center items-center opacity-70 shadow" disabled>
                                <span class="font-bold text-xs"><?php echo $slot; ?></span>
                                <span class="text-[10px] uppercase font-semibold">Sudah Dipesan</span>
                            </button>
                        <?php else: ?>
                            <!-- Available Slot -->
                            <button type="button" class="price-button border border-gray-300 bg-white text-gray-800 rounded-xl p-3 h-[60px] hover:border-green-500 hover:bg-green-50 transition-all w-full flex flex-col justify-center items-center shadow-sm cursor-pointer" 
                                data-harga="<?php echo $harga_lapangan; ?>" 
                                data-jam="<?php echo $slot; ?>">
                                <span class="font-bold text-xs slot-time"><?php echo $slot; ?></span>
                                <span class="text-[10px] text-green-600 font-semibold">Rp <?php echo number_format($harga_lapangan, 0, ',', '.'); ?></span>
                            </button>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
            
        </div>
    </div>

    <!-- Booking Summary Checkout Bar -->
    <div class="h-[60px] mt-8 flex justify-between items-center bg-gray-900 rounded-2xl p-4 shadow-xl text-white">
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-400">Jam Terpilih: <strong id="summary-jam" class="text-white">-</strong></span>
            <div class="h-6 w-px bg-gray-700"></div>
            <span class="text-sm text-gray-400">Total Harga: <strong id="summary-price" class="text-green-400 text-lg">Rp 0</strong></span>
        </div>
        <button type="submit" form="bookingForm" id="checkout-btn" class="bg-green-600 hover:bg-green-700 text-white px-8 py-2.5 rounded-xl font-bold transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2" disabled>
            <i class="fas fa-shopping-cart"></i>
            <span>Checkout</span>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const priceButtons = document.querySelectorAll('.price-button');
            const selectedPriceInput = document.getElementById('selected_price');
            const selectedJamInput = document.getElementById('selected_jam');
            
            const summaryJam = document.getElementById('summary-jam');
            const summaryPrice = document.getElementById('summary-price');
            const checkoutBtn = document.getElementById('checkout-btn');

            let selectedButton = null;

            priceButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Reset previously selected button styles
                    if (selectedButton) {
                        selectedButton.classList.remove('bg-green-600', 'text-white', 'border-green-600');
                        selectedButton.classList.add('bg-white', 'text-gray-800', 'border-gray-300');
                        selectedButton.querySelector('.text-green-600')?.classList.remove('text-white');
                        selectedButton.querySelector('.text-green-600')?.classList.add('text-green-600');
                    }

                    // Apply active styles to clicked button
                    button.classList.remove('bg-white', 'text-gray-800', 'border-gray-300');
                    button.classList.add('bg-green-600', 'text-white', 'border-green-600');
                    
                    const priceLabel = button.querySelector('span:last-child');
                    if (priceLabel) {
                        priceLabel.classList.remove('text-green-600');
                        priceLabel.classList.add('text-white');
                    }

                    selectedButton = button;

                    // Update form values
                    const harga = parseInt(button.getAttribute('data-harga'));
                    const jam = button.getAttribute('data-jam');
                    
                    selectedPriceInput.value = harga;
                    selectedJamInput.value = jam;

                    // Update UI summaries
                    summaryJam.textContent = jam;
                    summaryPrice.textContent = 'Rp ' + harga.toLocaleString('id-ID');
                    checkoutBtn.removeAttribute('disabled');
                });
            });
        });
    </script>
</body>
</html>