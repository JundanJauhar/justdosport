<?php
include '../server/koneksi.php';

// Di sini Anda dapat menambahkan logika untuk mengambil data dari database atau menampilkan informasi lainnya yang Anda inginkan di dashboard utama.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Just Do Sport</title>
    <style>
    body {
        font-family: "Inter", sans-serif;
        /* background-image: url('../assets/bg.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh;
        margin: 0;
        padding: 0; */
    }
    </style>
</head>

<body class='bg-green-600'>

    <!-- Navbar -->

    <?php include '../includes/Navbar.php'; ?>

    <!-- Content -->
    <div class="mt-[100px]">
        <?php include '../includes/Content/LandingPageContent.php'; ?>
    </div>






    <!-- Footer -->

    <?php include '../includes/Footer.php'; ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>


    </script>
</body>

</html>