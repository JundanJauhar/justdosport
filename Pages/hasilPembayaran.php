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

<body class='bg-green-600'>

<div class="absolute top-0">
        <?php include '../includes/Navbar.php'; ?>
    </div>    <div class="m-20 mx-72">

        <div class="grid grid-cols-2">
            <div>
                <h1 class="font-bold pb-5 w-full">Detail Pesanan</h1>

                <div class="grid grid-cols-2  w-[400px]">

                    <div class=" grid gap-5 ">
                        <div class="">
                            <h3>Pesanan</h3>
                        </div>
                        <div class="">
                            <h3>Nama Kustomer</h3>
                        </div>
                        <div class="">
                            <h3>No Telp</h3>
                        </div>
                        <div class="">
                            <h3>Email</h3>
                        </div>
                        <div class="">
                            <h3>Keterangan</h3>
                        </div>
                        <div class="">
                            <h3>Jumlah</h3>
                        </div>
                    </div>
                    <div class=" w-[400px] grid gap-5 ">

                        <h3>: Jakal Km 7 Futsal</h3>
                        <h3>: Bowok</h3>
                        <h3>: 0812223334444</h3>
                        <h3>: nganu@gmail.com</h3>
                        <h3>: Tidak ada keterangan</h3>
                        <h3>: 1(Satu)</h3>
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-3 h-[450px]">
                <div class="grid grid-cols-2 w-[400px]  ">
                    <div>
                        <h3>No Transaksi</h3>
                        <h3>Waktu Transaksi</h3>
                    </div>
                    <div>
                        <h3>: #1122333444455555</h3>
                        <h3>: 9 Maret 2024 - 11.11</h3>
                    </div>
                </div>
                <div class="w-[350px] border-solid border-2 h-[300px] pt-3">
                    <h3 class="font-bold">Catatan</h3>
                    <h3>1. Salin no. transaksi jika transaksi tanpa login.</h3>
                    <h3>2. Halaman tidak perlu kamu refresh, status transaksi akan update otomatis.</h3>
                    <h3>3. Jika perlu bantuan, chat ke CS Just do Sport via WhatsApp 0812223334444.</h3>
                    <h3>4. Selesaikan pembayaran sebelum batas waktu.</h3>
                    <h3>5. Bayar sesuai nominal yang diminta, termasuk kode unik jika ada.</h3>
                    <h3>6. Proses konfirmasi pembayaran otomatis 1-5 menit setelah kamu membayar.</h3>
                </div>
            </div>
        </div>
        <div class=" w-[500px]">
            <h1 class="font-bold">Detail Pembayaran</h1>
            <div class=" grid   gap-5">
                <div class=" flex justify-between">
                    <h3>Status Pembayaran</h3>
                    <h3 class="border-solid border-2 border-red-600 text-red-600 p-1 rounded-md">Belum Dibayar</h3>
                </div>
                <div class=" flex justify-between border-b-4 border-gray-500 border-solid pb-3">
                    <h3>Metode Pembayaran</h3>
                    <h3 class="flex font-bold"><img src="img\qris.png" class="w-16 h-15 mr-2" alt="">Qris</h3>
                </div>
                <div class=" flex justify-between">
                    <h3>Total Transaksi  </h3>
                    <h3>Rp70.000</h3>
                </div>
                <div class=" flex justify-between border-b-4 border-gray-500 border-solid pb-3">
                    <h3>Biaya pengananan</h3>
                    <h3>Rp5.000</h3>
                </div>
                <div class=" flex justify-between">
                    <h3>Total Pembayaran</h3>
                    <h3>Rp75.000</h3>
                </div>
            </div>

        </div>
    </div>
    <?php include "../includes/Footer.php" ?>
</body>

</html>