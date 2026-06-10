<?php
include "../server/koneksi.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get parameters
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ketersediaan Lapangan - Just Do Sport</title>
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
        
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-white tracking-tight">Cek Ketersediaan Lapangan</h1>
            <p class="text-green-400 mt-2">Pilih tanggal main dan temukan jam yang masih tersedia</p>
        </div>

        <div class="bg-white text-gray-800 rounded-3xl shadow-2xl p-6 md:p-8">
            
            <!-- Rating & Field Detail -->
            <div class="mb-8 border-b border-gray-100 pb-6">
                <?php include '../includes/lapangan&rating.php'; ?>
            </div>

            <!-- Legends -->
            <div class="flex flex-wrap justify-center items-center gap-6 mb-8 bg-gray-50 p-4 rounded-2xl border border-gray-200">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-4 h-4 bg-white border border-gray-300 rounded-md"></span>
                    <span class="text-xs font-semibold text-gray-600">Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-4 h-4 bg-green-600 rounded-md"></span>
                    <span class="text-xs font-semibold text-gray-600">Dipilih</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-4 h-4 bg-red-500 rounded-md"></span>
                    <span class="text-xs font-semibold text-gray-600">Tidak Tersedia (Booked)</span>
                </div>
            </div>

            <!-- Date Selector Section -->
            <div class="flex flex-col items-center mb-8">
                <label for="date-input" class="text-sm font-bold text-gray-500 mb-2 uppercase tracking-wider">Pilih Tanggal Bermain</label>
                <div class="relative w-full max-w-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="far fa-calendar-alt text-gray-400"></i>
                    </div>
                    <input type="date" name="selectedDate" id="date-input" value="<?php echo $tanggal; ?>" min="<?php echo date('Y-m-d'); ?>"
                        class="pl-10 pr-4 py-3 bg-gray-100 border border-gray-300 text-gray-900 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block w-full transition-all font-semibold outline-none">
                </div>
            </div>

            <!-- Time Slots -->
            <div id="timeSlots">
                <?php include '../includes/waktuPemesanan.php'; ?>
            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="w-full">
        <?php include '../includes/Footer.php'; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('date-input');
            
            // Reload page with new date parameter when changed
            dateInput.addEventListener('change', function() {
                const date = this.value;
                const urlParams = new URLSearchParams(window.location.search);
                const id = urlParams.get('id');
                window.location.href = `halamanKetersediaan.php?id=${id}&tanggal=${date}`;
            });
        });
    </script>
</body>
</html>
