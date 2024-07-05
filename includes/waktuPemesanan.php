<?php
include '../server/koneksi.php';

// Assuming you have the Pemandu's ID from the URL parameter
if (isset($_GET['id_tempatFutsal'])) {
    $id_tempatFutsal = $_GET['id_tempatFutsal'];

    // Query to retrieve data from relevant tables
    $query = "SELECT tempatfutsal.*, lapangan.*, jenis_lantai.*, jenis_lapangan.*, image_futsal.*, pemesanan.jam, pemesanan.harga 
    FROM tempatfutsal 
    JOIN lapangan ON tempatfutsal.id_tempatFutsal = lapangan.id_tempatFutsal
    JOIN jenis_lantai ON lapangan.id_lantai = jenis_lantai.id_lantai
    JOIN jenis_lapangan ON lapangan.id_jenisLapangan = jenis_lapangan.id_jenisLapangan
    JOIN image_futsal ON tempatfutsal.id_tempatFutsal = image_futsal.id_tempatFutsal
    LEFT JOIN pemesanan ON pemesanan.id_lapangan = lapangan.id_lapangan
    WHERE tempatfutsal.id_tempatFutsal = $id_tempatFutsal
    GROUP BY lapangan.id_lapangan, pemesanan.jam, pemesanan.harga";

    $sql = mysqli_query($koneksi, $query);

    // Check if the query is successful
    if ($sql) {
        // Initialize an empty array to store all rows
        $rows = array();

        // Fetch each row as an associative array
        while ($row = mysqli_fetch_assoc($sql)) {
            // Group by lapangan id to avoid duplicate lapangan entries
            $lapangan_id = $row['id_lapangan'];
            if (!isset($rows[$lapangan_id])) {
                $rows[$lapangan_id] = array(
                    'id_lapangan' => $row['id_lapangan'],
                    'nama_lapangan' => $row['nama_lapangan'],
                    'jenis_lapangan' => $row['jenis_lapangan'],
                    'jenis_lantai' => $row['jenis_lantai'],
                    'image' => $row['image'],
                    'pemesanan' => array(),
                );
            }
            // Add pemesanan data to lapangan
            if (!empty($row['jam']) && !empty($row['harga'])) {
                $rows[$lapangan_id]['pemesanan'][] = array(
                    'jam' => $row['jam'],
                    'harga' => $row['harga']
                );
            }
        }
    } else {
        // Handle the case where the query fails
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Handle the case where the Pemandu ID is not provided
    echo "ID is not specified.";
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
    <div class="mt-[10px] bg-white rounded-3xl p-5">
        <div class="grid grid-cols-1 gap-10 w-full">
            <?php foreach ($rows as $lapangan): ?>
                <div class="flex flex-col md:flex-row justify-between bg-white shadow-lg rounded-lg p-5 w-full">
                    <div class="flex flex-col md:flex-row rounded-lg p-4 shadow-md">
                        <div class="flex justify-center">
                            <img src="<?php echo $lapangan['image']; ?>" alt="Image"
                                class="w-[300px] h-[200px] rounded-lg mb-4 md:mb-0">
                        </div>
                        <div class="md:w-2/3 md:pl-4">
                            <p class="text-2xl font-mono mb-2"><?php echo $lapangan['nama_lapangan']; ?></p>
                            <div class="flex items-center mb-2">
                                <img src="https://ayo.co.id/assets/icon/map-pin-alt.png" class="w-5 h-5 mr-1" alt="">
                                <p class="text-md font-serif"><?php echo $lapangan['jenis_lapangan']; ?></p>
                            </div>
                            <div class="flex items-center">
                                <img src="https://ayo.co.id/assets/icon/grass.png" class="w-5 h-5 mr-1" alt="">
                                <p class="text-md font-serif"><?php echo $lapangan['jenis_lantai']; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="md:w-1/2 justify-center">
                        <form id="bookingForm" action="halamanPembayaran.php" method="POST">
                            <input type="hidden" name="selected_price" id="selected_price" value="0">
                            <div
                                class="border-2 border-solid p-4 grid md:grid-cols-4 gap-5 w-full rounded-lg shadow-sm all-seats">
                                <?php foreach ($lapangan['pemesanan'] as $pemesanan): ?>
                                    <button type="button" class="price-button" data-harga="<?php echo $pemesanan['harga']; ?>"
                                        id="btnWaktu">
                                        <div class="border-2 border-black border-solid text-center rounded-xl p-2 h-[50px]">
                                            <h3 class="font-bold text-[12px] text-black"><?php echo $pemesanan["jam"]; ?></h3>
                                            <h3 class="text-[10px] text-black opacity-75">Rp <?php echo $pemesanan["harga"]; ?>
                                            </h3>
                                        </div>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="h-[40px] mt-5 flex justify-center">
        <div class="total-price-display pt-2 pr-5 text-[25px]">Rp 0</div>
        <div class="bg-orange-600 w-[200px] h-10">
            <button type="submit" form="bookingForm">
                <h1 class="text-center pt-1 text-white text-[20px]">Checkout</h1>
            </button>
        </div>
    </div>
    <script src="waktuPemesanan.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all buttons with the class price-button
            const priceButtons = document.querySelectorAll('.price-button');
            const totalPriceDisplay = document.querySelector('.total-price-display');
            const selectedPriceInput = document.getElementById('selected_price');

            // Store the original background colors
            const originalBgColor = [];

            // Initialize total price
            let totalPrice = 0;

            // Store the currently selected button
            let selectedButton = null;

            // Add event listener for each price button
            priceButtons.forEach((button, index) => {
                originalBgColor[index] = button.style.backgroundColor || 'transparent';

                button.addEventListener('click', function () {
                    // Reset the background color of the previously selected button
                    if (selectedButton) {
                        selectedButton.style.backgroundColor = originalBgColor[Array.from(priceButtons).indexOf(selectedButton)];
                    }

                    // Set the background color of the clicked button to green
                    button.style.backgroundColor = 'green';

                    // Update the currently selected button
                    selectedButton = button;

                    // Update the total price and display it
                    const harga = parseInt(button.getAttribute('data-harga'));
                    totalPrice = harga;
                    totalPriceDisplay.textContent = 'Rp ' + totalPrice.toLocaleString();

                    // Update the hidden input value
                    selectedPriceInput.value = totalPrice;
                });
            });
        });

    </script>
</body>

</html>