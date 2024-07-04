<?php 
include '../../server/koneksi.php';
session_start();
include ('../../server/koneksi.php');
$nama = $_POST['nama'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE nama='$nama' AND password='$password'");
if (mysqli_num_rows($query)==1){
    header('Location:../../app/dashboard/index.php');
    $user = mysqli_fetch_array($query);
    $_SESSION['nama'] = $user['nama'];
    // $_SESSION['level'] = $user['level'];
}
else {
    header('Location:../login2.php');
}


?>