<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>
<style>
* {
    padding: 0,
        margin: 0,
}

.section2 {
    background-image: url('../../../justdosport/assets/andre-luis-rocha-sGwAKSQzGdM-unsplash.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.section2 input {
    backdrop-filter: blur(5px);
    background-color: rgba(255, 255, 255, 0.5);
    padding: 10px;
}

.section4 {
    background-image: url('../../../justdosport/assets/futsal.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(4px);
}
</style>




<body>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center" style='height: 100vh;'>
        <!-- Konten teks -->
        <div class="flex items-center justify-center w-4/5 mx-auto">
            <!-- Teks dan gambar sejajar -->
            <div class="text-start">
                <!-- Teks tengah pada layar kecil, kiri pada layar besar -->
                <div class="text-5xl text-white font-semibold mt-8 md:mt-0 px-12">
                    <!-- Berikan margin top pada layar kecil, tidak ada margin top pada layar besar -->
                    Membantu Temukan Lapangan Futsal
                </div>
                <p class='text-white font-normal text-sm px-12 w-96 mt-4'>Just Do Sport hadir untuk membantu
                    memesan lapangan futsal melalui web</p>
                <div class="flex float-start mt-4 px-12">
                    <button
                        class='px-3 py-3 bg-white text-green-600 hover:bg-gray-300 transition duration-300 rounded-sm'>
                        Temukan Lapangan
                    </button>
                    <div class="ml-4 mt-3 h-full">
                        <span class="items-center justify-center  ">
                            <svg class="w-6 h-6 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1" d="m1 9 4-4-4-4" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gambar -->
        <div class="text-center md:text-right">
            <!-- Teks tengah pada layar kecil, kanan pada layar besar -->
            <img src="../../../justdosport/assets/nendang-removebg-preview.png" alt="hero" class="w-full p-6">
            <!-- Mengisi lebar penuh div -->
        </div>
    </div>
    <section class='bg-white' id='sec-1'>
        <div class="text-center pt-6">
            <h1 class="text-4xl font-bold text-green-600">Layanan Kami</h1>
            <p class="text-gray-500">Just do Sport hadir menjadi solusi bagi kamu</p>
        </div>
        <div class="grid grid-cols-3 w-full mt-28 pb-32">
            <div class="mx-auto" id="card1">
                <a href="#"
                    class="block max-w-sm p-6  rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white  text-center">Jadwal
                        Lapangan
                    </h5>
                    <p class="font-normal text-white text-center">Anda dapat menyesuaikan jadwal
                        pertandingan sesuai kebutuhan.</p>
                </a>

            </div>
            <div class="mx-auto" id="card2">
                <a href="#"
                    class="block max-w-sm p-6 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white  text-center">Sewa
                        Lapangan</h5>
                    <p class="font-normal text-white text-center">Game Grid menawarkan layanan sewa
                        lapangan futsal yang fleksibel.</p>
                </a>
            </div>
            <div class="mx-auto" id="card3">

                <a href="#" class="block max-w-sm p-6  rounded-lg shadow hover:bg-gray-100 ">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white  text-center">
                        Pembayaran Online
                    </h5>
                    <p class="font-normal text-white text-center">Dapatkan kemudahan pemesanan
                        lapangan secara online.</p>
                </a>

            </div>
        </div>
    </section>
    <section class='section2 '>
        <div class="w-full h-full">
            <div class="flex h-full items-center justify-center">
                <div class="flex h-full items-center justify-center mt-20">
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 z-50" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-[300px] h-14 p-4 pl-12 text-sm text-gray-900 border text-center border-none bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari Lapangan Futsal" required />˝
                    </div>
                    <button class='px-6 h-14 bg-green-500 m-0 text-white'>Cari</button>
                </div>
            </div>
        </div>
            </section>
        <section class="section3 bg-white pb-6">
    <!-- card Lapangan Futsal-->
    <?php
    include '../server/koneksi.php';
    $query = "SELECT * FROM lapangan;";
    $sql = mysqli_query($koneksi, $query);
    $no = 0;
    ?>
    <h1 class='text-4xl text-green-600 font-bold text-center p-4'>Rekomendasi Lapangan Futsal Untuk Mu</h1>
    <div class="flex w-full">
        <div class="grid grid-cols-3 mx-auto gap-6 p-4 ">
            <?php while ($result = mysqli_fetch_assoc($sql)) : ?>
                <a href="halamanKetersediaan.php?id=<?php echo $result['id']; ?>" class="w-96 rounded-sm shadow-md p-4 block bg-gradient-to-r from-green-500 to-gray-900    ">
                    <img src="<?php echo $result['gambar']; ?>" alt="" class='w-full h-80' id="imgCard-1">
                    <h4 class='text-2xl font-semibold mt-2'><?php echo $result['namaLapangan']; ?></h4>
                    <h4 class='text-lg font-semibold'>Rp. <?php echo number_format($result['harga'], 0, ',', '.'); ?></h4>
                    <p><?php echo $result['alamat']; ?></p>
                    <div class="grid grid-cols-3 mt-2 gap-2">
                        <div class="grid">
                            <div class="flex w-full gap-2">
                                <img src="../../../justdosport/assets/lapangan.png" alt="" class=' w-6 h-6'>
                                <span class=" text-sm"><?php echo json_decode($result['fasilitas'])[0]; ?></span>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="flex w-full gap-2">
                                <img src="../../../justdosport/assets/wc.png" alt="" class=' w-6 h-6'>
                                <span class=" text-sm"><?php echo json_decode($result['fasilitas'])[1]; ?></span>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="flex w-full gap-2">
                                <img src="../../../justdosport/assets/musholla.png" alt="" class=' w-6 h-6'>
                                <span class=" text-sm"><?php echo json_decode($result['fasilitas'])[2]; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="grid mt-2">
                        <img src="../../../justdosport/assets/circum_parking-1.png" alt="" class='w-6 h-6'>
                        <p class='text-sm'><?php echo json_decode($result['fasilitas'])[3]; ?></p>
                    </div>
                    
                </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>

    <section class="section4">
        <div class="grid grid-cols-2 mx-auto w-full">
            <div class="mx-auto flex justify-center w-80">
                <h2 class='text-4xl text-white text-left font-semibold'>

                </h2>
            </div>
            <div class="">
                <div class="form max-w-sm p-6 mx-auto rounded-md">
                    <form class="max-w-sm mx-auto">
                        <h2 class='text-2xl font-semibold text-green-600 text-center mb-4'>Ada pertanyaan ?</h2>
                        <div class="mb-5">

                            <input type="text" placeholder='Masukkan email anda disini'
                                class="shadow-sm bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                required />
                        </div>
                        <div class="mb-5">

                            <input type="text" placeholder='Pertanyaan anda'
                                class="shadow-sm bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                required />
                        </div>

                        <button type="submit"
                            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none font-medium rounded-md text-sm px-5 py-2.5 text-center w-full">Kirim
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>


</body>

<script>
// Mengambil elemen card1, card
const card1 = document.getElementById('card1');
const card2 = document.getElementById('card2');
const card3 = document.getElementById('card3');

const imgCard1 =document.getElementById('imgCard-1')

imgCard1.addEventListener('click', function() {
    window.location.href = '../Pages/halamanKetersediaan.php'
})

imgCard1.addEventListener('mouseover', function() {
    imgCard1.style.cursor = 'pointer';
});

card1.style.backgroundImage = "url('../../../justdosport/assets/bg.png')";
card2.style.backgroundImage = "url('../../../justdosport/assets/bg.png')";
card3.style.backgroundImage = "url('../../../justdosport/assets/bg.png')";

card1.style.borderRadius = "8px";
card2.style.borderRadius = "8px";
card3.style.borderRadius = "8px";
</script>

</html>