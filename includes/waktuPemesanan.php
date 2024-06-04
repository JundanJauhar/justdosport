<?php
include '../server/koneksi.php';

$sql = "SELECT idWaktu, menit, jam, harga FROM pilihanwaktu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="./input.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<div class="container mx-auto p-5">
        <h2 class="text-3xl font-bold mb-5">Pilihan Waktu</h2>
        <div class="border-2 border-solid p-4 grid  md:grid-cols-3 gap-5 w-full h-[243px] rounded-lg shadow-sm">
            <?php
            $sql = "SELECT idWaktu, menit, jam, harga FROM pilihanwaktu";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="border-2 text-center rounded-xl p-2 h-[70px] bg-[#3F62A6] hover:bg-white hover:text-black transition duration-300">';
                    echo '<h3 class="text-[10px] text-white opacity-75">' . $row["menit"] . ' Menit</h3>';
                    echo '<h3 class="font-bold text-[13px] text-white">' . $row["jam"] . '</h3>';
                    echo '<h3 class="text-[10px] text-white opacity-75">Rp' . number_format($row["harga"], 0, ',', '.') . '</h3>';
                    echo '</div>';
                }
            } else {
                echo "<p class='text-center'>0 results</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
