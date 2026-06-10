<?php
include '../server/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_lapangan = intval($_POST['id_lapangan']);
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $harga = intval($_POST['harga']);
    $nama_kustomer = $_POST['nama_kustomer'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $metode_pembayaran = $_POST['metode_pembayaran'];
    
    // Generate transaction number
    $no_transaksi = 'JDS-' . date('Ymd') . '-' . rand(1000, 9999);
    $status_pembayaran = 'Belum Dibayar';

    // Insert query
    $query = "INSERT INTO pemesanan (id_lapangan, tanggal, jam, harga, nama_kustomer, no_telp, email, keterangan, metode_pembayaran, status_pembayaran, no_transaksi)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($koneksi, $query)) {
        mysqli_stmt_bind_param($stmt, "ississsssss", 
            $id_lapangan, 
            $tanggal, 
            $jam, 
            $harga, 
            $nama_kustomer, 
            $no_telp, 
            $email, 
            $keterangan, 
            $metode_pembayaran, 
            $status_pembayaran, 
            $no_transaksi
        );
        
        if (mysqli_stmt_execute($stmt)) {
            $order_id = mysqli_insert_id($koneksi);

            // Insert notification for the owner
            $field_query = mysqli_query($koneksi, "SELECT id_pemilik, namaLapangan FROM lapangan WHERE id = $id_lapangan");
            if ($field_query && $field_row = mysqli_fetch_assoc($field_query)) {
                $id_pemilik = intval($field_row['id_pemilik']);
                $nama_lap = mysqli_real_escape_string($koneksi, $field_row['namaLapangan']);
                
                if ($id_pemilik > 0) {
                    $notif_pesan = "Booking baru masuk untuk lapangan <strong>$nama_lap</strong> oleh kustomer <strong>" . mysqli_real_escape_string($koneksi, $nama_kustomer) . "</strong> pada tanggal " . date('d F Y', strtotime($tanggal)) . " jam <strong>" . mysqli_real_escape_string($koneksi, $jam) . "</strong>.";
                    mysqli_query($koneksi, "INSERT INTO notifikasi (id_pemilik, pesan) VALUES ($id_pemilik, '$notif_pesan')");
                }
            }

            header("Location: hasilPembayaran.php?order_id=" . $order_id);
            exit();
        } else {
            echo "Error executing statement: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request method.";
}
?>
