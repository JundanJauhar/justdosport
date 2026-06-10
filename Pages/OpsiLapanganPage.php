<?php
include '../server/koneksi.php';

// Menambahkan variabel $conn ke global
global $conn;

// Query untuk mengambil data lapangan dari database
$sql = "SELECT * FROM lapangan";
$result = $conn->query($sql);

// Inisialisasi array untuk menyimpan data lapangan
$lapanganList = array();

// Periksa jika query berhasil dieksekusi dan menghasilkan data
if ($result->num_rows > 0) {
    // Ambil setiap baris data dan masukkan ke dalam array
    while ($row = $result->fetch_assoc()) {
        $lapanganList[] = $row;
    }
} else {
    // Jika tidak ada data ditemukan, set array lapanganList kosong
    $lapanganList = array();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Just Do Sport</title>
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    /* body {
        display: flex;
        flex-direction: column;
        background-image: url('../assets/bg.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    } */

    .card-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        margin-top: 120px;
    }
    </style>
</head>

<body class='bg-green-600'>

    <div>
        <?php include '../includes/Navbar.php'; ?>
    </div>

    <div class="card-content">
        <div class="flex w-full pb-20">
            <div class="grid grid-cols-3 gap-4 mx-auto">
                <?php include '../includes/Content/OpsiLapanganCard.php'; ?>
            </div>
        </div>
    </div>

    <div class="">

    </div>

    <div>
        <?php include '../includes/Footer.php'; ?>
    </div>

</body>

<script></script>

</html>