# 🎯 Just Do Sport - Aplikasi Pemesanan Lapangan Futsal

Aplikasi web untuk membantu pengguna menemukan dan memesan lapangan futsal dengan mudah.

## ✅ Status Perbaikan

- ✅ **Database Fixed** - Semua tabel sudah benar dan terkoneksi
- ✅ **JavaScript Errors Fixed** - Navbar dan script berfungsi dengan baik
- ✅ **Gambar Updated** - Menggunakan gambar dari Unsplash (berkualitas tinggi)
- ✅ **Admin Panel** - Sistem CRUD lengkap untuk mengelola lapangan
- ✅ **UI Enhanced** - Tampilan lebih menarik dengan Tailwind CSS
- ✅ **Responsive Design** - Bekerja di desktop, tablet, dan mobile

---

## 🚀 Cara Menjalankan Proyek

### 1. **Persiapan Awal**
```powershell
# Pastikan Laragon sudah berjalan
# - Apache aktif (hijau)
# - MySQL aktif (hijau)
```

### 2. **Setup Database**
```powershell
# Buka PowerShell dan jalankan:
cd d:\XboxGames\laragon\www\justdosport-master\server

# Buat database baru
mysql -u root -p -e "DROP DATABASE IF EXISTS justdosport;"
mysql -u root -p -e "CREATE DATABASE justdosport;"

# Import struktur database
mysql -u root -p justdosport < justdosport2.sql
```

### 3. **Tambah Sample Data dengan Gambar**
Buka di browser:
```
http://localhost/justdosport-master/admin/seed_data.php
```

Ini akan menambahkan 5 lapangan futsal dengan gambar dari Unsplash.

### 4. **Install Node.js Dependencies** (Opsional)
```powershell
cd d:\XboxGames\laragon\www\justdosport-master
npm install
```

### 5. **Compile Tailwind CSS** (Opsional)
```powershell
npx tailwindcss -i input.css -o output.css --watch
```

---

## 📱 Mengakses Aplikasi

### **Landing Page (Publik)**
```
http://localhost/justdosport-master/Pages/LandingPage.php
```
- Tampilkan daftar lapangan futsal
- Filter dan pencarian lapangan
- Lihat detail lapangan

### **Admin Panel (Kelola Data)**
```
http://localhost/justdosport-master/admin/index.php
```

---

## 🔧 Fitur Admin Panel

### **CRUD Lapangan (Create, Read, Update, Delete)**

#### 📝 **Create - Tambah Lapangan Baru**
1. Klik tombol "Tambah Lapangan"
2. Isi form dengan data:
   - Nama Lapangan
   - Harga per jam
   - Alamat
   - Fasilitas (pisahkan dengan koma)
   - Kontak
   - URL Gambar (dari Unsplash/Pexels/URL lain)
   - Deskripsi
3. Klik "Simpan"

#### 👀 **Read - Lihat Daftar Lapangan**
- Tabel menampilkan semua lapangan
- Sorting otomatis (terbaru di atas)
- Informasi: Nama, Harga, Alamat, Kontak

#### ✏️ **Update - Edit Lapangan**
1. Klik tombol "Edit" pada baris lapangan
2. Ubah data yang diperlukan
3. Preview gambar akan ditampilkan
4. Klik "Perbarui"

#### 🗑️ **Delete - Hapus Lapangan**
1. Klik tombol "Hapus"
2. Konfirmasi penghapusan
3. Lapangan terhapus dari database

---

## 🖼️ Cara Menggunakan Gambar dari Web

### **Opsi 1: Unsplash (Recommended)**
1. Buka https://unsplash.com/
2. Search "futsal court" atau "sports field"
3. Klik gambar yang disukai
4. Copy URL gambar (klik kanan → Copy Link)
5. Paste di field "URL Gambar"

**Contoh URL:**
```
https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&h=600&fit=crop
```

### **Opsi 2: Pexels**
1. Buka https://www.pexels.com/
2. Search "futsal" atau "sports court"
3. Klik gambar
4. Copy direct link
5. Paste di form

### **Opsi 3: Pixabay**
1. Buka https://pixabay.com/
2. Search "futsal court"
3. Copy link gambar
4. Paste di form

---

## 📊 Struktur Database

### **Table: lapangan**
```
- id (INT, PRIMARY KEY)
- namaLapangan (TEXT)
- harga (INT)
- alamat (TEXT)
- fasilitas (TEXT)
- kontakLapangan (TEXT)
- gambar (TEXT) ← URL gambar
- ketlapangan (TEXT)
```

### **Table: pilihanlapangan**
```
- idPilihan (INT, PRIMARY KEY)
- idFutsal (INT, FOREIGN KEY)
- cabor (VARCHAR)
- ruangan (VARCHAR)
- lantai (VARCHAR)
- img (VARCHAR)
```

### **Table: pilihanwaktu**
```
- idWaktu (INT, PRIMARY KEY)
- idLapangan (INT, FOREIGN KEY)
- tanggal (DATE)
- menit (INT)
- jam (VARCHAR)
- harga (INT)
```

---

## 🎨 Perbaikan UI yang Sudah Dilakukan

1. **Card Design** - Kartu lapangan dengan hover effect
2. **Image Optimization** - Gambar responsif dan loading proper
3. **Color Scheme** - Green (#10b981) sebagai primary color
4. **Typography** - Font hierarchy yang jelas
5. **Spacing** - Padding dan margin konsisten
6. **Responsive** - Mobile-first design dengan Tailwind CSS
7. **Shadow & Border** - Efek kedalaman dengan shadow
8. **Button Styling** - Tombol dengan hover dan transition effects

---

## 🔐 Keamanan Database

### **SQL Injection Prevention**
Menggunakan `mysqli_real_escape_string()` untuk semua input:
```php
$nama = mysqli_real_escape_string($koneksi, $_POST['namaLapangan']);
```

### **Input Validation**
- URL gambar divalidasi dengan `filter_var()`
- Nomor divalidasi dengan `is_numeric()`
- String maksimal panjang

---

## 🚨 Troubleshooting

| Problem | Solusi |
|---------|--------|
| **Gambar tidak muncul** | Cek URL gambar bisa diakses di browser |
| **Error "Table doesn't exist"** | Jalankan `mysql -u root -p justdosport < justdosport2.sql` |
| **MySQL error** | Pastikan MySQL Laragon running (`laragon start`) |
| **Admin panel tidak bisa diakses** | Cek permission folder `/admin` |
| **Data tidak tersimpan** | Cek koneksi database di `server/koneksi.php` |

---

## 📂 Struktur Folder

```
justdosport-master/
├── admin/
│   ├── index.php              ← Dashboard admin
│   ├── tambah_lapangan.php    ← Form tambah
│   ├── edit_lapangan.php      ← Form edit
│   ├── proses.php             ← Handle CRUD
│   └── seed_data.php          ← Generate sample data
├── Pages/
│   ├── LandingPage.php        ← Halaman utama
│   ├── OpsiLapanganPage.php
│   └── OrderPage.php
├── includes/
│   ├── Navbar.php
│   ├── Footer.php
│   ├── Navbar.js
│   └── Content/
│       └── LandingPageContent.php
├── server/
│   ├── koneksi.php            ← Database connection
│   ├── justdosport2.sql       ← Database structure
│   └── chatbot.js
└── assets/
    ├── logo.png
    └── [gambar lainnya]
```

---

## 💡 Tips & Tricks

### **Mengganti Logo**
Edit `includes/Navbar.php`:
```php
<img src="../assets/logo.png" class="h-10 w-10" alt="Logo" />
```

### **Menambah Menu Navbar**
Edit `includes/Navbar.php` dan tambahkan:
```html
<a href="#">Menu Baru</a>
```

### **Mengubah Warna Theme**
Edit `Pages/LandingPage.php` dan ganti `from-green-500` dengan warna lain.

---

## 📞 Support

Jika ada pertanyaan atau error, silakan:
1. Cek file `server/koneksi.php` untuk konfigurasi database
2. Cek browser console (F12) untuk JavaScript errors
3. Cek Laragon log untuk PHP errors

---

## 📝 Checklist Sebelum Deploy

- [ ] Database sudah di-backup
- [ ] Semua gambar URL sudah valid
- [ ] Admin panel sudah ditest
- [ ] Email/notifikasi sudah dikonfigurasi
- [ ] SSL certificate sudah di-setup (untuk HTTPS)
- [ ] User permissions sudah diatur dengan benar

---

**Happy Booking! ⚽**
