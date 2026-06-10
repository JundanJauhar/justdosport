<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Just Do Sport</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(20px); }
        }

        .service-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border-color: #10b981;
        }

        .lapangan-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
        }

        .lapangan-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 30px 60px rgba(16, 185, 129, 0.2);
            border-color: #10b981;
        }

        .lapangan-card .image-container {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .lapangan-card .image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.3) 0%, transparent 50%);
        }

        .badge-price {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.875rem;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        .section-title {
            position: relative;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
            border-radius: 2px;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-box {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            color: white;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <!-- HERO SECTION -->
    <div class="hero-section relative pt-20 pb-32 px-4 md:px-8 lg:px-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 items-center min-h-[85vh]">
                <!-- Left Content -->
                <div class="relative z-10">
                    <div class="fade-in">
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                            Temukan Lapangan <span class="block text-yellow-300">Futsal Impianmu</span>
                        </h1>
                        <p class="text-lg md:text-xl text-green-50 mb-8 leading-relaxed">
                            Pesan lapangan futsal terbaik di kota Anda dengan mudah. Harga terjangkau, fasilitas lengkap, dan pelayanan terbaik.
                        </p>
                        <div class="flex gap-4 flex-wrap">
                            <button class="bg-white text-green-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg hover:shadow-2xl transform hover:scale-105 duration-300 flex items-center gap-2">
                                <i class="fas fa-search"></i> Cari Lapangan
                            </button>
                            <button id="toggleChat" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-green-600 transition duration-300 flex items-center gap-2">
                                <i class="fas fa-comments"></i> Tanya Kami
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="relative z-10 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-300 to-orange-400 rounded-2xl blur-3xl opacity-30"></div>
                        <img src="../assets/sport (1).png" alt="Futsal Player" class="relative rounded-2xl w-full shadow-2xl transform hover:scale-105 transition duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SERVICES SECTION -->
    <section class="bg-gradient-to-b from-white to-gray-50 py-20 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 section-title mb-4">Mengapa Pilih Just Do Sport?</h2>
                <p class="text-lg text-gray-600">Layanan terbaik untuk kebutuhan futsal Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="service-card bg-white p-8 rounded-2xl">
                    <div class="icon-box mb-4">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Jadwal Fleksibel</h3>
                    <p class="text-gray-600 leading-relaxed">Pilih waktu bermain yang sesuai dengan jadwal Anda. Tersedia mulai pukul 7 pagi hingga malam hari.</p>
                </div>

                <!-- Service 2 -->
                <div class="service-card bg-white p-8 rounded-2xl">
                    <div class="icon-box mb-4">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Pembayaran Mudah</h3>
                    <p class="text-gray-600 leading-relaxed">Bayar via transfer bank, e-wallet, atau cash. Proses cepat dan aman tanpa ribet.</p>
                </div>

                <!-- Service 3 -->
                <div class="service-card bg-white p-8 rounded-2xl">
                    <div class="icon-box mb-4">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Fasilitas Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed">Lapangan standar, parkir luas, kamar mandi bersih, dan ruang istirahat yang nyaman.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- LAPANGAN LIST SECTION -->
        <?php
        include '../server/koneksi.php';

        // Query menggunakan table lapangan yang benar dari database
        $query = "SELECT * FROM lapangan ORDER BY id DESC";
        $sql = mysqli_query($koneksi, $query);

        // Debugging output
        if (!$sql) {
            echo "Query Error: " . mysqli_error($koneksi);
        }

        $no = 0;
        ?>
        <div class="max-w-7xl mx-auto py-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 section-title mb-4">Lapangan Futsal Pilihan</h2>
                <p class="text-lg text-gray-600">Pilih lapangan terbaik dengan harga kompetitif</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($result = mysqli_fetch_assoc($sql)): ?>
                    <a href="halamanKetersediaan.php?id=<?php echo $result['id']; ?>"
                        class="lapangan-card bg-white rounded-2xl overflow-hidden group cursor-pointer">
                        
                        <!-- Image Container -->
                        <div class="image-container relative h-80 overflow-hidden">
                            <img src="<?php echo $result['gambar']; ?>" alt="<?php echo $result['namaLapangan']; ?>" class='w-full h-full object-cover group-hover:scale-110 transition duration-500' />
                            
                            <!-- Price Badge -->
                            <div class="badge-price">
                                Rp <?php echo number_format($result['harga'], 0, ',', '.'); ?>/jam
                            </div>

                            <!-- Rating Badge -->
                            <div class="absolute top-4 left-4 bg-white bg-opacity-90 px-3 py-1 rounded-full flex items-center gap-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="text-sm font-semibold text-gray-900">4.8</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class='text-2xl font-bold text-gray-900 mb-2'><?php echo $result['namaLapangan']; ?></h3>
                            
                            <!-- Location -->
                            <div class="flex items-start gap-2 mb-4">
                                <i class="fas fa-map-marker-alt text-green-600 mt-1 flex-shrink-0"></i>
                                <p class='text-sm text-gray-600'><?php echo substr($result['alamat'], 0, 50); ?>...</p>
                            </div>

                            <!-- Contact -->
                            <div class="flex items-center gap-2 mb-4">
                                <i class="fas fa-phone text-green-600"></i>
                                <p class='text-sm text-gray-600'><?php echo $result['kontakLapangan']; ?></p>
                            </div>

                            <!-- Description - SIMPLIFIED -->
                            <div class="mb-4 pb-4 border-t border-gray-200">
                                <p class='text-sm text-gray-700 line-clamp-2'><?php echo substr($result['ketlapangan'], 0, 100); ?>...</p>
                            </div>

                            <!-- Facilities -->
                            <div class="flex gap-2 flex-wrap">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Parkir
                                </span>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-water mr-1"></i>Kamar Mandi
                                </span>
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-mosque mr-1"></i>Musholla
                                </span>
                            </div>

                            <!-- CTA Button -->
                            <button class="w-full mt-6 bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg font-bold hover:shadow-lg transition transform hover:scale-105 duration-300">
                                <i class="fas fa-calendar-check mr-2"></i> Pesan Sekarang
                            </button>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </section>


    <!-- CONTACT SECTION -->
    <section class="bg-gradient-to-r from-green-600 via-green-500 to-emerald-600 py-20 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Hubungi Kami</h2>
                    <p class="text-lg text-green-50 mb-8">Punya pertanyaan? Tim kami siap membantu Anda 24/7</p>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">Telepon</h3>
                                <p class="text-green-100">+62 821 3456 7890</p>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">Email</h3>
                                <p class="text-green-100">info@justdosport.com</p>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-bold text-lg">Lokasi</h3>
                                <p class="text-green-100">Yogyakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Form -->
                <div>
                    <form class="bg-white rounded-2xl p-8 shadow-2xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Nama Anda</label>
                            <input type="text" placeholder="Masukkan nama..." class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 transition">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" placeholder="Masukkan email..." class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 transition">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">Pesan</label>
                            <textarea placeholder="Tulis pesan Anda..." rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-green-500 transition resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-bold py-3 rounded-lg hover:shadow-lg transition transform hover:scale-105 duration-300">
                            <i class="fas fa-send mr-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Simple toggle chat button
        document.getElementById('toggleChat').addEventListener('click', function() {
            alert('Chatbot sedang dipersiapkan. Hubungi kami melalui form kontak!');
        });

        // Add animation to cards
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeIn 0.6s ease-out';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.service-card, .lapangan-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
