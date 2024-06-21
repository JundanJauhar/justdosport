<!DOCTYPE html>
<?php
include 'server\koneksi.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.login.css">
    <link rel="stylesheet" href="css\style.css">
    
    <title>Tour Guide Login</title>
</head>
<body>
    <div class="login-container">
        <form action="loginconnect.php" method="post">
        <h1 class="m-0 text-primary"><span class="text-dark">TOUR</span>GUIDE</h1>
            <h2>Tour Guide Login</h2>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Login" onclick="validasi()">

            <h4>Belum punya akun? <a href="registrasiWisatawan.php">registrasi</a></h4>
        </form>
        <h4>Mau jadi Pemandu? <a href="registrasiPemandu.php">Daftar Dulu</a></h4>
    </div>
</body>
</html>
