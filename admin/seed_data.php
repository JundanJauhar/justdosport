<?php
include __DIR__ . '/../server/koneksi.php';

// Disable foreign key checks to allow truncating
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 0");
mysqli_query($koneksi, "TRUNCATE TABLE ulasan");
mysqli_query($koneksi, "TRUNCATE TABLE pemesanan");
mysqli_query($koneksi, "TRUNCATE TABLE notifikasi");
mysqli_query($koneksi, "TRUNCATE TABLE lapangan");
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS = 1");

// Realistic demo data covering Futsal, Badminton, Sepak Bola, and Tenis
$lapanganData = [
    [
        'nama' => 'GOR Bulutangkis Smash',
        'harga' => 50000,
        'alamat' => 'Jl. Kaliurang Km 8, Yogyakarta',
        'fasilitas' => 'Kantin, Kamar Mandi, Parkir, Karpet Vinyl',
        'kontak' => '0812-3456-7890',
        'gambar' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=800&h=600&fit=crop',
        'ket' => 'Arena badminton indoor premium dengan 4 lapangan karpet vinyl standar nasional.',
        'cabor' => 'Badminton',
        'id_pemilik' => 1
    ],
    [
        'nama' => 'Hall Badminton Pro',
        'harga' => 45000,
        'alamat' => 'Jl. Gejayan No. 12, Yogyakarta',
        'fasilitas' => 'Kamar Mandi, Parkir Motor, Sewa Raket',
        'kontak' => '0821-9876-5432',
        'gambar' => 'https://images.unsplash.com/photo-1521537634581-0dccd2ece334?w=800&h=600&fit=crop',
        'ket' => 'Tempat latihan badminton yang nyaman dengan pencahayaan LED standar kompetisi.',
        'cabor' => 'Badminton',
        'id_pemilik' => 1
    ],
    [
        'nama' => 'Jakal 7 Futsal',
        'harga' => 90000,
        'alamat' => 'Jl. Kaliurang, Km. 7, Yogyakarta',
        'fasilitas' => 'Parkir, Kamar Mandi, Musholla, Kantin',
        'kontak' => '(0274) 880864',
        'gambar' => 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?w=800&h=600&fit=crop',
        'ket' => 'Lapangan futsal rumput sintetis indoor dengan 3 lapangan berukuran standar.',
        'cabor' => 'Futsal',
        'id_pemilik' => 1
    ],
    [
        'nama' => 'Meteor Futsal Arena',
        'harga' => 100000,
        'alamat' => 'Jl. Kaliurang, Km 12.5, Yogyakarta',
        'fasilitas' => 'Parkir Luas, Kamar Mandi, Musholla, Cafe',
        'kontak' => '0888-0687-9888',
        'gambar' => 'https://images.unsplash.com/photo-1552667449-8631fc08231f?w=800&h=600&fit=crop',
        'ket' => 'Lapangan futsal berlantai interlock premium dengan sirkulasi udara yang baik.',
        'cabor' => 'Futsal',
        'id_pemilik' => 1
    ],
    [
        'nama' => 'Stadion Mini Mandala (Soccer)',
        'harga' => 250000,
        'alamat' => 'Kawasan Stadion Mandala Krida, Yogyakarta',
        'fasilitas' => 'Tribun Penonton, Kamar Mandi, Parkir Luas, Bench Pemain',
        'kontak' => '0813-2222-3333',
        'gambar' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=800&h=600&fit=crop',
        'ket' => 'Lapangan sepak bola mini outdoor dengan rumput alami super hijau, sangat cocok untuk fun football 7v7.',
        'cabor' => 'Sepak Bola',
        'id_pemilik' => 1
    ],
    [
        'nama' => 'Green Turf Soccer Field',
        'harga' => 200000,
        'alamat' => 'Jl. Ring Road Utara, Yogyakarta',
        'fasilitas' => 'Parkir, Kamar Mandi, Kafe, Sewa Sepatu',
        'kontak' => '0877-6666-8888',
        'gambar' => 'https://images.unsplash.com/photo-1431324155629-1a6edd1d141d?w=800&h=600&fit=crop',
        'ket' => 'Lapangan sepak bola mini sintetis berstandar FIFA, ramah lutut dan nyaman digunakan siang maupun malam.',
        'cabor' => 'Sepak Bola',
        'id_pemilik' => 1
    ],
    [
        'nama' => 'Tennis Court Mandala',
        'harga' => 75000,
        'alamat' => 'Jl. Komplek Olahraga Mandala, Yogyakarta',
        'fasilitas' => 'Parkir, Kamar Mandi, Sewa Bola & Raket',
        'kontak' => '0856-7777-9999',
        'gambar' => 'https://images.unsplash.com/photo-1595435934249-5df7ed86e1c0?w=800&h=600&fit=crop',
        'ket' => 'Lapangan tenis outdoor hardcourt dengan permukaan yang rata dan pantulan bola yang stabil.',
        'cabor' => 'Tenis',
        'id_pemilik' => 1
    ],
    [
        'nama' => 'Tenis Indoor Executive',
        'harga' => 120000,
        'alamat' => 'Jl. Solo Km 5, Yogyakarta',
        'fasilitas' => 'Indoor AC, Shower Air Hangat, Parkir, Cafe',
        'kontak' => '0812-9999-0000',
        'gambar' => 'https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?w=800&h=600&fit=crop',
        'ket' => 'Lapangan tenis indoor eksklusif terhindar dari panas dan hujan dengan fasilitas premium.',
        'cabor' => 'Tenis',
        'id_pemilik' => 1
    ]
];

// Insert data
$count = 0;
foreach ($lapanganData as $data) {
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $harga = intval($data['harga']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $fasilitas = mysqli_real_escape_string($koneksi, $data['fasilitas']);
    $kontak = mysqli_real_escape_string($koneksi, $data['kontak']);
    $gambar = mysqli_real_escape_string($koneksi, $data['gambar']);
    $ket = mysqli_real_escape_string($koneksi, $data['ket']);
    $cabor = mysqli_real_escape_string($koneksi, $data['cabor']);
    $id_pemilik = intval($data['id_pemilik']);

    $query = "INSERT INTO lapangan (namaLapangan, harga, alamat, fasilitas, kontakLapangan, gambar, ketlapangan, cabor, id_pemilik) 
              VALUES ('$nama', '$harga', '$alamat', '$fasilitas', '$kontak', '$gambar', '$ket', '$cabor', $id_pemilik)";

    if (mysqli_query($koneksi, $query)) {
        $count++;
        echo "✓ Berhasil menambah arena: $nama ($cabor)\n";
    } else {
        echo "✗ Error: " . mysqli_error($koneksi) . "\n";
    }
}
?>

Database Seeding Selesai. Total arena berhasil ditambahkan: <?php echo $count; ?>
