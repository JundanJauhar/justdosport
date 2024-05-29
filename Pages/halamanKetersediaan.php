<?php
include "../server/koneksi.php"
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

<body class='bg-green-600'>

    <div class="absolute top-0">
        <?php include '../includes/Navbar.php'; ?>
    </div>
    <div class=" m-16 mx-32 mt-[120px]">

        <?php include '../includes/lapangan&rating.php' ?>

        <div class="flex justify-between mb-3">
            <div></div>
            <div class="  flex gap-5 ">
                <h1 class=" bg-[#3F62A6] w-20 h-12 text-center pt-2">Tersedia</h1>
                <h1 class="bg-[#FFC700] w-20 h-12 text-center pt-2">Dipilih</h1>
                <h1 class="bg-[#D9D9D9] w-20 h-12 text-center">Tidak Tersedia</h1>
            </div>
        </div>
        <div class="grip ">
        <div class="bg-gray-500 h-20 mb-10 flex items-center justify-center">
    <input type="datetime-local"  name="" class="date-input p-2 border-none h-auto bg-gray-500 text-white focus:outline-none focus:border-none " id="datetime-input">
</div>

            <div>

            </div>
        </div>
        <?php include '../includes/pilihanLapangan.php' ?>
        <?php include '../includes/pilihanLapangan.php' ?>
        <?php include '../includes/pilihanLapangan.php' ?>
        <?php include '../includes/navbarBawah.php' ?><br>

    </div>
    <?php include '../includes/footer.php' ?>
    </div>
</body>

<script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const input = document.getElementById('datetime-input');
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;
            input.value = formattedDateTime;
        });
    </script>
</html>