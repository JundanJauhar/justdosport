<!DOCTYPE html>
<html lang="en">

<?php
include '../server/koneksi.php';
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="./input.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" bg-green-600">
    
<div class="absolute-0">
        <?php include '../includes/Navbar.php'; ?>
    </div>
    <div class="'m-16 mx-32">

        <div class=" grid   gap-5 items-center pt-[180px]">
            <div class="flex gap-5">
                <img src="..\assets\images (2).jpeg" class="size-80 w-[620px] drop-shadow-md" alt="">
                <div class=" grid gap-2">

                    <img src="..\assets\images (2).jpeg" class=" size-36 w-[300px] h-[155px] drop-shadow-md" alt="">
                    <img src="..\assets\images (2).jpeg" class=" size-36 w-[300px] h-[155px] drop-shadow-md" alt="">
                </div>
                <div class=" ml-16">
                    <h1 class="text-2xl font-serif">JAKAL KM 7 FUTSAL</h1>
                    <h3 class=" font-thin">Sleman, Yogyakarta</h3>
                </div>

            </div>
            <div class="border-x-4 border-gray-300 ">

            </div>

            <div class="grid grid-cols-2 ">
                <div class=" ml-16 border-solid border-2 border-gray-300 p-5 w-[450px] h-[350px]">
                    <div>
                        <h1 class="text-[20px] mb-5 font-bold">Detail Customer</h1>
                        <div class="flex">
                            <div>
                                <form action="/action_page.php ">
                                    <div class="flex gap-4">
                                        <div>
                                            <label for="lname">Nama:</label><br>
                                            <input type="text" id="lname" name="lname"
                                                class=" border-solid border-2  h-8 border-gray-300 "
                                                placeholder=""><br><br>
                                        </div>
                                        <div>
                                            <label for="lname">No Telp:</label><br>
                                            <input type="text" id="lname" name="lname"
                                                class=" border-solid border-2  h-8 border-gray-300 "
                                                placeholder=""><br><br>
                                        </div>
                                    </div>
                                    <label for="lname">Email:</label><br>
                                    <input type="text" id="lname" name="lname"
                                        class=" border-solid border-2  h-8 w-full border-gray-300 "
                                        placeholder=""><br><br>
                                    <label for="lname">Keterangan:</label><br>
                                    <input type="text" id="lname" name="lname"
                                        class=" border-solid border-2  h-8 border-gray-300 w-full"
                                        placeholder=""><br><br>
                                </form>
                            </div>
                            <div></div>
                        </div>
                    </div>
                </div>

                <div class=" border-solid border-2 border-gray-300 p-5 w-[550px] h-[650px] ">
                    <div>
                        <h1 class="text-[20px]  font-bold">Pilih Jenis Pembayaran</h1>
                        <h3 class="mb-5 text-gray-400">Semua transaksi yang dilakukan aman dan terenkripsi</h3>
                        <div>
                            <div class=" grid gap-5    p-5">
                                <div class="">

                                    <div>
                                        <h1 for="lname"
                                            class=" bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2 ">
                                            Transfer
                                            Virtual Akun</h1>
                                    </div>
                                    <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                        <button>
                                            <img src="..\assets\bni.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\bri.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\mandiri.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\bca.jpeg" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                    </div>
                                </div>

                                <div>

                                    <div>
                                        <h1 for="lname"
                                            class=" bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2">
                                            e-Wallets</h1>
                                    </div>
                                    <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                        <button>
                                            <img src="..\assets\dana.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\gopay.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\ovo.jpeg" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\qris.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\shopee.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                    </div>

                                </div>
                                <div>

                                    <div>
                                        <h1 for="lname"
                                            class=" bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2">
                                            Credit Card Payment</h1>
                                    </div>
                                    <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                        <button>
                                            <img src="..\assets\visa.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\master card.png" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button>
                                            <img src="..\assets\jcb.jpeg" alt=""
                                                class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 h-full">
                <label for="">JAKAL KM 7 Futsal</label>
                <h3 class=" text-green-800">Minggu, 10 Maret 2024 ( 15.00 - 16.00 )</h3>
                <div class=" justify-between flex py-5">
                    <h3>Harga Lapangan</h3>
                    <h3>Rp120.000</h3>
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
                    <h3>Rp125.000</h3>
                </div>
            </div>
            <div class="Selesaikan Pembayaran items-center text-center ">
            <a href="hasilPembayaran.php">
                
                <button class="w-[350px] h-[50px] bg-orange-600 text-center text-white font-bold py-3">SelesaikanPembayaran</button>
            </a>
            </div>
        </div>
        
    </div>
    <?php include '../includes/footer.php' ?>
</body>

</html>