<?php 
require_once __DIR__ . '/../../server/koneksi.php';
session_start();

$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE nama='$nama'");
if ($query && mysqli_num_rows($query) == 1){
    $user = mysqli_fetch_assoc($query);
    // Verifikasi password hash, fallback ke plaintext untuk kompatibilitas
    if (password_verify($password, $user['password']) || $password === $user['password']) {
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['alamat'] = $user['alamat'];
        $_SESSION['user_id'] = $user['id_pengguna'];
        $_SESSION['role'] = $user['role'];
        
        if ($user['role'] === 'owner') {
            header('Location: ../../admin/index.php');
        } else {
            if (isset($_SESSION['checkout_pending'])) {
                header('Location: ../../Pages/halamanPembayaran.php');
            } else {
                header('Location: ../../Pages/LandingPage.php');
            }
        }
        exit();
    }
}

// Jika gagal, redirect kembali ke login2.php dengan error
header('Location: ../login2.php?error=Username%20atau%20Password%20salah!');
exit();
?>