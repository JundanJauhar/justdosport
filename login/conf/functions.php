<?php
require 'config.php';

function registrasi($data) {
    global $conn;

    $email = strtolower(stripslashes($data["email"]));
    $nama = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);
    $alamat = mysqli_real_escape_string($conn, $data["alamat"]);

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
    $query = "INSERT INTO pengguna (email, nama, password, alamat) VALUES ('$email', '$nama', '$password', '$alamat')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>
