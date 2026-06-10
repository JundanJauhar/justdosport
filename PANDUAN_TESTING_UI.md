# 🎨 PANDUAN TESTING UI BARU

## ⚡ Quick Start (5 Menit)

### Step 1: Jalankan Laragon
```
1. Buka Laragon
2. Klik "Start All" (Apache & MySQL)
3. Tunggu status hijau
```

### Step 2: Buka Landing Page
```
Buka browser dan paste URL:
http://localhost/justdosport-master/Pages/LandingPage.php
```

### Step 3: Lihat Perubahan
```
✅ Hero section (bagian atas) - Hijau gradient dengan animasi
✅ Services section - 3 kotak dengan icons
✅ Lapangan cards - Modern dengan badges
✅ Contact section - Form dengan layout 2 kolom
```

---

## 🧪 Testing Checklist

### ✅ VISUAL TESTING
- [ ] Hero section terlihat dengan background gradient hijau
- [ ] 2 tombol CTA berwarna putih dan transparan
- [ ] Gambar futsal player muncul di sebelah kanan
- [ ] Section titles memiliki underline hijau
- [ ] Card lapangan memiliki price badge orange di top-right
- [ ] Rating badge ⭐ 4.8 di top-left card
- [ ] Facility tags (Parkir, Kamar Mandi, Musholla) berwarna

### ✅ ANIMASI TESTING
- [ ] Hover di card lapangan → card naik + shadow membesar
- [ ] Hover di service card → card naik + shadow membesar
- [ ] Tombol "Pesan Sekarang" berubah warna saat hover
- [ ] Gambar di hero section besar saat hover
- [ ] Hero section ada efek float animation (subtle)

### ✅ RESPONSIVITAS TESTING
```
MOBILE (< 640px):
- [ ] Tekan F12 untuk developer tools
- [ ] Pilih iPhone 12 / Mobile view
- [ ] Cek: cards 1 kolom, full width
- [ ] Cek: text masih readable
- [ ] Cek: buttons clickable
```

```
TABLET (640-1024px):
- [ ] Pilih iPad / Tablet view
- [ ] Cek: cards 2 kolom
- [ ] Cek: layout balanced
- [ ] Cek: spacing ok
```

```
DESKTOP (> 1024px):
- [ ] Normal browser view
- [ ] Cek: cards 3 kolom
- [ ] Cek: maksimal 1200px width
- [ ] Cek: spacing bagus
```

### ✅ FUNGSIONALITAS TESTING
- [ ] Klik "Cari Lapangan" → harus navigate ke halaman cari
- [ ] Klik "Tanya Kami" → alert muncul (chatbot pending)
- [ ] Klik "Pesan Sekarang" pada card → navigate ke halaman ketersediaan
- [ ] Form kontak styling bagus
- [ ] Input field border berubah saat focus (hijau)

### ✅ KONTEN TESTING
- [ ] Deskripsi lapangan lebih singkat (1-2 kalimat)
- [ ] Semua 5 lapangan tampil dengan gambar
- [ ] Price format: Rp XX.XXX/jam (format ribuan)
- [ ] Lokasi dan kontak terlihat
- [ ] Tidak ada text overflow

### ✅ CROSS-BROWSER TESTING
- [ ] Chrome - Normal ✅
- [ ] Firefox - Normal ✅
- [ ] Safari - Normal ✅
- [ ] Edge - Normal ✅

### ✅ PERFORMANCE TESTING
- [ ] Page load cepat (< 3 detik)
- [ ] Animasi smooth (no lag)
- [ ] Images dari Unsplash loading ok
- [ ] No console errors (F12 → Console)

---

## 🐛 Troubleshooting

### Gambar tidak muncul?
```
1. Cek internet connection (gambar dari Unsplash)
2. Clear cache: Ctrl+Shift+Del
3. Hard refresh: Ctrl+F5
4. Tunggu beberapa detik
```

### Styling tidak berubah?
```
1. Ctrl+F5 (force refresh)
2. Clear browser cache
3. Close & reopen browser
4. Try different browser
```

### Animasi lag/jittery?
```
1. Close other tabs/programs
2. Try different browser
3. Check GPU acceleration enabled
```

### Card tidak hover/clickable?
```
1. Check F12 console untuk errors
2. Pastikan JavaScript enabled
3. Hard refresh page
```

---

## 📸 Expected Visual Result

### Hero Section
```
[Hijau gradient background]
[Text besar putih]
"Temukan Lapangan Futsal Impianmu"
[2 tombol: Cari Lapangan | Tanya Kami]
[Gambar futsal player di kanan]
```

### Services Section
```
[3 Kotak dengan icon]
[🕐] Jadwal Fleksibel     [💳] Pembayaran Mudah    [⭐] Fasilitas Lengkap
```

### Lapangan Cards
```
┌─────────────────┐
│   [Gambar]      │  ← Rp 90.000/jam (badge orange, top-right)
│                 │  ← ⭐ 4.8 (top-left)
├─────────────────┤
│ Jakal 7 Futsal  │
│📍 Jl. Kaliurang │
│📞 (0274) 880864 │
│                 │
│Deskripsi singkat│
│   1-2 kalimat   │
│                 │
│[Parkir][Kamar][...]│
│[Pesan Sekarang] │  ← Button green
└─────────────────┘
```

### Contact Section
```
[Hijau gradient background]
[2 Kolom Layout]
[Kiri: Info contact]    [Kanan: Form kontak]
```

---

## 📊 Testing Report Template

```
Tanggal: ___________
Browser: ___________
Device: ___________

Visual: ✅ / ⚠️ / ❌
Animasi: ✅ / ⚠️ / ❌
Responsive: ✅ / ⚠️ / ❌
Fungsionalitas: ✅ / ⚠️ / ❌
Performance: ✅ / ⚠️ / ❌

Catatan:
_____________________
_____________________
```

---

## ✅ Sign-off Criteria

**Testing PASSED ketika:**
1. ✅ Semua visual elements tampil dengan benar
2. ✅ Animasi smooth tanpa lag
3. ✅ Responsive di mobile, tablet, desktop
4. ✅ No console errors
5. ✅ All buttons functional
6. ✅ Deskripsi singkat tampil
7. ✅ Images load ok
8. ✅ Performance acceptable

---

## 🎬 Next Steps

Setelah testing:
1. Screenshot untuk dokumentasi
2. Report bugs jika ada
3. Deploy ke production (optional)
4. Update admin untuk info perubahan

---

**Happy Testing! 🎉**

Jika ada pertanyaan, cek file: `PERUBAHAN_UI_TERBARU.md`
