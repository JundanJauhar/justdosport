<?php
include '../server/koneksi.php';
?>

<div class="container mx-auto p-5">
        <h2 class="text-3xl font-bold mb-5">Pilihan Lapangan</h2>
        <div class="">
            <?php
            $sql = "SELECT idPilihan, cabor, ruangan, lantai, img FROM pilihanlapangan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="flex border-2 p-5 rounded-lg bg-white shadow-sm mb-4">';
                    echo '<div class="mr-10">';
                    echo '<img src="' . $row["img"] . '" class="w-[300px] h-[200px] drop-shadow-md rounded-xl" alt="">';
                    echo '</div>';
                    echo '<div>';
                    echo '<h1 class="text-2xl font-mono mb-2">Lapangan ' . $row["cabor"] . '</h1>';
                    echo '<p class="text-md font-serif mb-3">Lapangan ' . $row["cabor"] . ' dengan ukuran yang sesuai standar.</p>';
                    echo '<p class="text-md font-sans flex items-center gap-1 mb-2"><img src="https://ayo.co.id/assets/icon/trophy.png" class="w-5 h-5" alt="">' . $row["cabor"] . '</p>';
                    echo '<p class="text-md font-serif flex items-center gap-1 mb-2"><img src="https://ayo.co.id/assets/icon/map-pin-alt.png" class="w-5 h-5" alt="">' . $row["ruangan"] . '</p>';
                    echo '<p class="text-md font-serif flex items-center gap-1"><img src="https://ayo.co.id/assets/icon/grass.png" class="w-5 h-5" alt="">' . $row["lantai"] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p class='text-center'>0 results</p>";
            }
            ?>
        </div>
    </div>
    
