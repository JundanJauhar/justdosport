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
</head>



<body>
    <div class="bg-green-600">

        <!-- Navbar -->

        <?php include '../includes/Navbar.php'; ?>



        <!-- Content -->

        <?php include '../includes/Content/OrderPageContent.php'; ?>





        <!-- Footer -->

        <?php include '../includes/Footer.php'; ?>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>