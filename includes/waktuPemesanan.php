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
    <div class=" mt-[10px] bg-white rounded-3xl p-5">
        <div class="grid grid-cols-1 gap-10 w-full">
            <div class="flex flex-col md:flex-row justify-between bg-white shadow-lg rounded-lg p-5 w-full">
                <div class="flex flex-col md:flex-row  rounded-lg p-4 shadow-md">
                    <div class=" flex justify-center">
                        <img src="https://lh3.googleusercontent.com/p/AF1QipM8mmdwhKOqq36LvO9wLRXWoPXFSQJ6ZGDCf4F6=s1360-w1360-h1020"
                            class="w-[300px] h-[200px] rounded-lg mb-4 md:mb-0" alt="">
                    </div>
                    <div class="md:w-2/3 md:pl-4">
                        <p class="text-2xl font-mono mb-2">Jakal 7 Futsal</p>

                        <div class="flex items-center mb-2">
                            <img src="https://ayo.co.id/assets/icon/trophy.png" class="w-5 h-5 mr-1" alt="">
                            <p class="text-md font-sans">Futsal</p>
                        </div>
                        <div class="flex items-center mb-2">
                            <img src="https://ayo.co.id/assets/icon/map-pin-alt.png" class="w-5 h-5 mr-1" alt="">
                            <p class="text-md font-serif">Indoor</p>
                        </div>
                        <div class="flex items-center">
                            <img src="https://ayo.co.id/assets/icon/grass.png" class="w-5 h-5 mr-1" alt="">
                            <p class="text-md font-serif">Vinyl</p>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2  justify-center">
                    <div class="border-2 border-solid p-4 grid md:grid-cols-4 gap-5 w-full rounded-lg shadow-sm">

                        <button id="btnWaktu">
                        <div class=" border-2 border-black border-solid  text-center rounded-xl p-2 h-[50px]  ">

                                <h3 class="font-bold text-[12px] text-black">09:00 - 10:00</h3>
                                <h3 class="text-[10px] text-black opacity-75">
                                    Rp120,000
                                </h3>
                            </div>
                        </button>

                        <div
                            class="border-2 text-center rounded-xl p-2 h-[50px] bg-green-400 hover:bg-white hover:text-black transition duration-300">
                            <h3 class="font-bold text-[12px] text-white">10:00 - 11:00</h3>
                            <h3 class="text-[10px] text-white opacity-75">
                                Rp130,000
                            </h3>
                        </div>
                    </div>
                    <p class="text-center">No results</p>
                </div>
            </div>
        </div>
    </div>
    <Script id="./waktuPemesanan.js"></Script>
</body>

</html>