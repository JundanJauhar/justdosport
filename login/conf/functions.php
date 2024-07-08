<?php
require '../../server/koneksi.php';

function registrasi($data) {
    global $koneksi;

    $email = strtolower(stripslashes($data["email"]));
    $nama = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["konfirmasi_password"]);
    $alamat = mysqli_real_escape_string($koneksi, $data["alamat"]);

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan data ke database
    $query = "INSERT INTO pengguna (email, nama, password, alamat) VALUES ('$email', '$nama', '$password', '$alamat')";u
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
?>
