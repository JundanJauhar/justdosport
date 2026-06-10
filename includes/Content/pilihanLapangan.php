<?php

$sql = "SELECT * FROM lapangan";
$result = $conn->query($sql);
$lapanganList = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lapanganList[] = $row;
    }
}

foreach ($lapanganList as $row) {
    $img = htmlspecialchars($row['img']);
    $cabor = htmlspecialchars($row['cabor']);
    $ruangan = htmlspecialchars($row['ruangan']);
    $lantai = htmlspecialchars($row['lantai']);
    
    echo '
    <div class="border-solid">
        <img src="' . $img . '" class="size-36 w-[300px] h-[200px] drop-shadow-md rounded-xl mr-10" alt="">
    </div>
    <div>
        <h1 class="text-2xl font-mono ml-10">Lapangan ' . $cabor . '</h1>
        <h1 class="text-md font-serif ml-10 mb-3">Lapangan ' . $cabor . ' dengan ukuran yang sesuai standart</h1>
        <h1 class="text-md font-sans ml-10 flex gap-1"><img src="https://ayo.co.id/assets/icon/trophy.png" class="size-5" alt="">' . $cabor . '</h1>
        <h1 class="text-md font-serif ml-10 flex gap-1"><img src="https://ayo.co.id/assets/icon/map-pin-alt.png" class="size-5" alt="">' . $ruangan . '</h1>
        <h1 class="text-md font-serif ml-10 flex gap-1"><img src="https://ayo.co.id/assets/icon/grass.png" class="size-5" alt="">' . $lantai . '</h1>
    </div>';
}
?>
