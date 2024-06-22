<?php
include '../server/koneksi.php';

// Assuming you have the Pemandu's ID from the URL parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM lapangan WHERE id = $id;";
    $sql = mysqli_query($koneksi, $query);

    // Check if the query is successful
    if ($sql) {
        $row = mysqli_fetch_assoc($sql);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAKAL KM 7 FUTSAL</title>
    <link rel="stylesheet" href="./output.css">
    <link rel="stylesheet" href="./input.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
            height: 500px;
            border-radius: 1.5rem 1.5rem 0 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }

        .carousel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 1.5rem 1.5rem 0 0;
        }

        .carousel-content {
            text-align: center;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .carousel-background {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
            z-index: 1;
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }


        .carousel-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 3;
        }

        .carousel-nav button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 5px;
        }

        .carousel-indicators button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        .carousel-indicators button.active {
            background-color: white;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="carousel-container">
        <div class="carousel">
            <img src="<?php echo $row['gambar']; ?>" alt="Image 1">
        </div>
        <div class="carousel-nav">
            <button id="prevBtn">&lt;</button>
            <button id="nextBtn">&gt;</button>
        </div>
        <div class="carousel-indicators">
            <button class="active" data-index="0"></button>
            <button data-index="1"></button>
            <button data-index="2"></button>
        </div>
    </div>


    <section>
        <div class="p-4 mt-6 w-[100%]">
            <h1 class="text-3xl font-semibold text-gray-900"><?php echo $row['namaLapangan']; ?></h1>
            <h3 class="text-xl font-medium text-gray-700"><?php echo $row['alamat']; ?></h3>
            <div class="border-solid border-gray-300 border-2 rounded-md p-5 mt-4 w-full">
                <p>
                    <strong class="text-lg font-medium text-gray-800">Fasilitas:</strong>
                </p>
                <ul class="list-disc list-inside mt-2">
                    <li class=" text-justify w-full"><?php echo $row['ketlapangan'] ?></li>
                </ul>
            </div>
        </div>
    </section>


   
</body>
<script>
        const images = document.querySelectorAll('.carousel img');
        const indicators = document.querySelectorAll('.carousel-indicators button');
        let currentIndex = 0;

        function showImage(index) {
            const offset = -index * 100;
            document.querySelector('.carousel').style.transform = `translateX(${offset}%)`;
            indicators.forEach((button, i) => {
                button.classList.toggle('active', i === index);
            });
        }

        document.getElementById('nextBtn').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        });

        indicators.forEach(button => {
            button.addEventListener('click', () => {
                currentIndex = parseInt(button.getAttribute('data-index'));
                showImage(currentIndex);
            });
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }, 3000); // Change image every 3 seconds

        showImage(currentIndex);
    </script>

</html>