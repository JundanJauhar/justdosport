<?php
include '../server/koneksi.php'; // Sertakan file koneksi database Anda

session_start();

// Ambil data dari form
$selected_price = isset($_POST['selected_price']) ? $_POST['selected_price'] : 0;
$id_tempatFutsal = isset($_POST['id_tempatFutsal']) ? $_POST['id_tempatFutsal'] : 0;
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
$jam = isset($_POST['jam']) ? $_POST['jam'] : '';

// Siapkan dan jalankan query untuk memasukkan data
$stmt = $koneksi->prepare("INSERT INTO pemesanan (tanggal, jam, harga, id_tempatFutsal) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $tanggal, $jam_mulai, $selected_price, $id_tempatFutsal);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_price'])) {
    $selectedAmount = $_POST['selected_price'];
    $_SESSION['selectedAmount'] = $selectedAmount;
} else {
    $selectedAmount = isset($_SESSION['selectedAmount']) ? $_SESSION['selectedAmount'] : 0;
}

if ($stmt->execute()) {
    echo "Pemesanan berhasil!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
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

<body class="bg-gradient-to-r from-green-500 to-gray-900 bg-[url('../assets/nendang-removebg-preview.png')]">

    <div class="absolute-0">
        <?php include '../includes/Navbar.php'; ?>
    </div>

    <div class="m-16 mx-32 border-solid border-2 border-white p-10 mt-5 rounded-3xl bg-white">
        <div class="grid gap-5 items-center pt-[180px]">
            <div class="flex gap-5">
                <img src="../assets/images (2).jpeg" class="size-80 w-[620px] drop-shadow-md" alt="">
                <div class="grid gap-2">
                    <img src="../assets/images (2).jpeg" class="size-36 w-[300px] h-[155px] drop-shadow-md" alt="">
                    <img src="../assets/images (2).jpeg" class="size-36 w-[300px] h-[155px] drop-shadow-md" alt="">
                </div>
                <div class="ml-16">
                    <h1 class="text-2xl font-serif"><?php echo isset($result['nama']) ? $result['nama'] : ''; ?></h1>
                    <h3 class="font-thin">Sleman, Yogyakarta</h3>
                </div>
            </div>
            <div class="border-x-4 border-gray-300"></div>
            <div class="grid grid-cols-2">
                <div class="ml-16 border-solid border-2 border-gray-300 p-5 w-[450px] h-[350px]">
                    <h1 class="text-[20px] mb-5 font-bold">Detail Customer</h1>
                    <form action="halamanPembayaran.php" method="post">
                        <div class="flex gap-4">
                            <div>
                                <label for="lname">Nama:</label><br>
                                <input type="text" id="lname" name="lname"
                                    class="border-solid border-2 h-8 border-gray-300" placeholder=""><br><br>
                            </div>
                            <div>
                                <label for="lname">No Telp:</label><br>
                                <input type="text" id="lname" name="lname"
                                    class="border-solid border-2 h-8 border-gray-300" placeholder=""><br><br>
                            </div>
                        </div>
                        <label for="lname">Email:</label><br>
                        <input type="text" id="lname" name="lname"
                            class="border-solid border-2 h-8 w-full border-gray-300" placeholder=""><br><br>
                        <label for="lname">Keterangan:</label><br>
                        <input type="text" id="lname" name="lname"
                            class="border-solid border-2 h-8 border-gray-300 w-full" placeholder=""><br><br>
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <div class="border-solid border-2 border-gray-300 p-5 w-[550px] h-[650px]">
                    <h1 class="text-[20px] font-bold">Pilih Jenis Pembayaran</h1>
                    <h3 class="mb-5 text-gray-400">Semua transaksi yang dilakukan aman dan terenkripsi</h3>
                    <div class="grid gap-5 p-5">
                        <div>
                            <h1 class="bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2">Transfer
                                Virtual Akun</h1>
                            <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                <button><img src="../assets/bni.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/bri.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/mandiri.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/bca.jpeg" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                            </div>
                        </div>
                        <div>
                            <h1 class="bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2">e-Wallets</h1>
                            <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                <button><img src="../assets/dana.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/gopay.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/ovo.jpeg" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/qris.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/shopee.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                            </div>
                        </div>
                        <div>
                            <h1 class="bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2">Credit Card
                                Payment</h1>
                            <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                <button><img src="../assets/visa.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/master card.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                                <button><img src="../assets/amex.png" alt=""
                                        class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 h-full">
            <label for="">JAKAL KM 7 Futsal</label>
            <h3 class="text-green-800"><?php echo isset($result['jam']) ? $result['jam'] : ''; ?></h3>
            <div class="justify-between flex py-5">
                <h3>Harga Lapangan</h3>
                <div class="pt-2 pr-5 text-[25px]">Rp <?php echo number_format($selectedAmount, 0, ',', '.'); ?></div>
            </div>
            <div class="garis border-solid border-t-2 flex justify-between py-5">
                <h3>Service Fee</h3>
                <h3>Rp5.000</h3>
            </div>
            <div class="border-solid border-t-2 pt-5">
                <h3>Total bayar</h3>
            </div>
            <div class="total bayar justify-between flex py-5 text-red-600">
                <h3>Bayar Penuh</h3>
                <h3>Rp <?php echo number_format($selectedAmount + 5000, 0, ',', '.'); ?></h3>
            </div>
        </div>
        <div class="Selesaikan Pembayaran items-center text-center">
            <a href="hasilPembayaran.php">
                <button type="submit"
                    class="w-[350px] h-[50px] bg-orange-600 text-center text-white font-bold py-3">Selesaikan
                    Pembayaran</button>
            </a>
        </div>
        <input type="hidden" name="harga" value="<?php echo $selectedAmount + 5000; ?>">
        <input type="hidden" name="id_tempatFutsal" value="<?php echo $id_tempatFutsal; ?>">
        <input type="hidden" name="tanggal" value="2024-03-10">
        </div>
        </div>
        </div>
        <?php include '../includes/footer.php'; ?>
    </div>

</body>
<script>
    document.querySelectorAll('.price-button').forEach(button => {
        button.addEventListener('click', function () {
            const harga = this.getAttribute('data-harga');
            document.getElementById('selected_price').value = harga;
            document.querySelector('.total-price-display').textContent = 'Rp ' + harga;
        });
    });
</script>

</html>