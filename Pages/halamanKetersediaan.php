<?php
include "../server/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="./input.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class='bg-gradient-to-r from-green-500 to-gray-900'>
    <form action="../includes/proseshalamanketersediaan.php" method="POST"></form>

    <div class="absolute top-0 rounded-md ">
        <?php include '../includes/Navbar.php'; ?>
    </div>
    <div class="mx-32 mt-[120px] bg-white rounded-3xl ">
        <div>
            <?php include '../includes/lapangan&rating.php' ?>
        </div>

        <div class="flex p-2 mb-3">
            <div class="flex mx-auto gap-5 ">
                <h1 class="bg-white w-20 h-12 text-center pt-2 border-gray-300 border-2">Tersedia</h1>
                <h1 class="bg-green-600 w-20 h-12 text-center pt-2">Dipilih</h1>
                <h1 class="bg-orange-700 w-20 h-12 text-center">Tidak Tersedia</h1>
            </div>
        </div>
        <div class="flex p-2 ">
            <div class="bg-gray-500 h-20 mb-10 flex justify-center w-96 mx-auto">
                <input type="date" name="selectedDate"
                    class="date-input p-2 border-none h-auto bg-gray-500 text-white focus:outline-none focus:border-none"
                    id="date-input">
            </div>
        </div>
        <div id="timeSlots">
            <?php include '../includes/waktuPemesanan.php' ?>
        </div>
        <?php include '../includes/navbarBawah.php' ?><br>
    </div>
    <?php include '../includes/footer.php' ?>
    </div>
</body>
<script src="../includes/waktuPemesanan.js"></script>


</html>
