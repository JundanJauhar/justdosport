<?php
session_start();
include '../server/koneksi.php';

// Validate owner session
if (!isset($_SESSION['nama']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
    header('Location: ../login/login2.php?error=' . urlencode('Silakan login sebagai Pemilik Lapangan terlebih dahulu!'));
    exit();
}

$id_pemilik = intval($_SESSION['user_id']);
$action = $_POST['action'] ?? $_GET['action'] ?? null;

if ($action === 'tambah') {
    // Create - Tambah lapangan baru
    $namaLapangan = mysqli_real_escape_string($koneksi, $_POST['namaLapangan']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $fasilitas = mysqli_real_escape_string($koneksi, $_POST['fasilitas']);
    $kontakLapangan = mysqli_real_escape_string($koneksi, $_POST['kontakLapangan']);
    $gambar = mysqli_real_escape_string($koneksi, $_POST['gambar']);
    $ketlapangan = mysqli_real_escape_string($koneksi, $_POST['ketlapangan']);

    $query = "INSERT INTO lapangan (namaLapangan, harga, alamat, fasilitas, kontakLapangan, gambar, ketlapangan, id_pemilik) 
              VALUES ('$namaLapangan', '$harga', '$alamat', '$fasilitas', '$kontakLapangan', '$gambar', '$ketlapangan', '$id_pemilik')";

    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php?success=Lapangan%20berhasil%20ditambahkan');
    } else {
        header('Location: index.php?error=' . urlencode(mysqli_error($koneksi)));
    }
}

elseif ($action === 'edit') {
    // Update - Edit lapangan
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    
    // Check ownership first
    $check = mysqli_query($koneksi, "SELECT id FROM lapangan WHERE id = '$id' AND id_pemilik = '$id_pemilik'");
    if (!$check || mysqli_num_rows($check) == 0) {
        header('Location: index.php?error=Aksi%20ditolak%3A%20Bukan%20lapangan%20Anda');
        exit();
    }

    $namaLapangan = mysqli_real_escape_string($koneksi, $_POST['namaLapangan']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $fasilitas = mysqli_real_escape_string($koneksi, $_POST['fasilitas']);
    $kontakLapangan = mysqli_real_escape_string($koneksi, $_POST['kontakLapangan']);
    $gambar = mysqli_real_escape_string($koneksi, $_POST['gambar']);
    $ketlapangan = mysqli_real_escape_string($koneksi, $_POST['ketlapangan']);

    $query = "UPDATE lapangan SET 
              namaLapangan = '$namaLapangan',
              harga = '$harga',
              alamat = '$alamat',
              fasilitas = '$fasilitas',
              kontakLapangan = '$kontakLapangan',
              gambar = '$gambar',
              ketlapangan = '$ketlapangan'
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php?success=Lapangan%20berhasil%20diperbarui');
    } else {
        header('Location: index.php?error=' . urlencode(mysqli_error($koneksi)));
    }
}

elseif ($action === 'hapus') {
    // Delete - Hapus lapangan
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Check ownership first
    $check = mysqli_query($koneksi, "SELECT id FROM lapangan WHERE id = '$id' AND id_pemilik = '$id_pemilik'");
    if (!$check || mysqli_num_rows($check) == 0) {
        header('Location: index.php?error=Aksi%20ditolak%3A%20Bukan%20lapangan%20Anda');
        exit();
    }

    $query = "DELETE FROM lapangan WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        header('Location: index.php?success=Lapangan%20berhasil%20dihapus');
    } else {
        header('Location: index.php?error=' . urlencode(mysqli_error($koneksi)));
    }
}

elseif ($action === 'status_pesanan') {
    // Update booking status
    $id_pesan = intval($_GET['id_pesan']);
    $status = mysqli_real_escape_string($koneksi, $_GET['status']);

    // Validate that the booking belongs to a field owned by the logged-in owner
    $check_query = "SELECT p.id FROM pemesanan p 
                    JOIN lapangan l ON p.id_lapangan = l.id 
                    WHERE p.id = $id_pesan AND l.id_pemilik = $id_pemilik";
    $check_res = mysqli_query($koneksi, $check_query);

    if ($check_res && mysqli_num_rows($check_res) > 0) {
        $update_query = "UPDATE pemesanan SET status_pembayaran = '$status' WHERE id = $id_pesan";
        if (mysqli_query($koneksi, $update_query)) {
            header('Location: index.php?success=Status%20pesanan%20berhasil%20diubah&tab=pesanan');
        } else {
            header('Location: index.php?error=' . urlencode(mysqli_error($koneksi)));
        }
    } else {
        header('Location: index.php?error=Aksi%20ditolak');
    }
}

elseif ($action === 'clear_notif') {
    // Clear all notifications for this owner
    $query_clear = "UPDATE notifikasi SET is_read = 1 WHERE id_pemilik = $id_pemilik";
    if (mysqli_query($koneksi, $query_clear)) {
        header('Location: index.php?success=Semua%20notifikasi%20telah%20dibaca&tab=notif');
    } else {
        header('Location: index.php?error=' . urlencode(mysqli_error($koneksi)));
    }
}

else {
    header('Location: index.php?error=Aksi%20tidak%20dikenali');
}
?>
