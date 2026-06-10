<?php
include 'server/koneksi.php';
session_start();


if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] === 'tambah') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $konfirmPassword = $_POST['konfirmPassword'];
        $email = $_POST['email'];

        if ($password != $konfirmPassword){
            echo "Password and Konfirm Password tidak sesuai";
        } else {
            $query = "INSERT INTO akunuser VALUES (null, '$username', '$password', '$konfirmPassword', '$email')";
        }

            header("location : Pages\LandingPage.php");
        exit();
    }
}





?>