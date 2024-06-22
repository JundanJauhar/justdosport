<?php
include "../server/koneksi.php";

if (isset($_GET['idPilihan'])) {
    $idPilihan = $_GET['idPilihan'];

    $query = "SELECT * FROM pilihanlapangan;";
    $sql = mysqli_query($koneksi, $query);

    // Check if the query is successful
    if ($sql) {
        $row = mysqli_fetch_assoc($sql);
        $no = 0;
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Handle the case where the Pemandu ID is not provided
    echo "Pemandu ID is not specified.";
    exit();
}
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
    <div class="mx-32 mt-[10px] bg-white rounded-3xl p-5">
        <div class="grid grid-cols-1 gap-10">
     
                    <div class="flex flex-col md:flex-row justify-between bg-white shadow-lg rounded-lg p-5">
                        <div class="md:w-1/2">
                            <img src="<?= $rowLapangan['img'] ?>" class="w-full h-auto rounded-lg mb-4 md:mb-0" alt="">
                            <div>
                                <p class="text-2xl font-mono mb-2"><?= $rowLapangan['namaLapangan'] ?></p>
                                <p class="text-md font-serif mb-3"><?= $rowLapangan['ketlapangan'] ?></p>
                                <p class="text-md font-sans flex items-center gap-1 mb-2">
                                    <img src="https://ayo.co.id/assets/icon/trophy.png" class="w-5 h-5" alt="">
                                    <?= $rowLapangan['cabor'] ?>
                                </p>
                                <p class="text-md font-serif flex items-center gap-1 mb-2">
                                    <img src="https://ayo.co.id/assets/icon/map-pin-alt.png" class="w-5 h-5" alt="">
                                    <?= $rowLapangan['ruangan'] ?>
                                </p>
                                <p class="text-md font-serif flex items-center gap-1">
                                    <img src="https://ayo.co.id/assets/icon/grass.png" class="w-5 h-5" alt="">
                                    <?= $rowLapangan['lantai'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="md:w-1/2 flex flex-col justify-center">
                            <div class="border-2 border-solid p-4 grid md:grid-cols-3 gap-5 w-full rounded-lg shadow-sm">
                                <?php
                                if ($resultWaktu->num_rows > 0) {
                                    while ($rowWaktu = mysqli_fetch_assoc($resultWaktu)) {
                                        ?>
                                        <div
                                            class="border-2 text-center rounded-xl p-2 h-[70px] bg-green-400 hover:bg-white hover:text-black transition duration-300">
                                            <h3 class="text-[10px] text-white opacity-75"><?= $rowWaktu['menit'] ?> Menit</h3>
                                            <h3 class="font-bold text-[13px] text-white"><?= $rowWaktu['jam'] ?></h3>
                                            <h3 class="text-[10px] text-white opacity-75">
                                                Rp<?= number_format($rowWaktu['harga'], 0, ',', '.') ?></h3>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <p class="text-center">No results</p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                
           
        </div>
    </div>
</body>

</html>