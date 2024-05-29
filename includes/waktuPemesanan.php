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
    <div class=" border-2 border-solid  py-2 px-5 grid grid-cols-4  gap-5 w-[700px] ">
    <button id="colorButton" class="<?php echo $buttonColor; ?>" name="submit">

            <div class=" border-2 text-center rounded-xl p-2 h-[70px] w-[120px] bg-[#3F62A6] hover:bg-white">
                <h3 class=" text-[10px] text-white opacity-75 ">60 Menit</h3>
                <h3 class="font-bold text-[13px]">07.00 - 08.00</h3>
                <h3 class=" text-[10px] text-white opacity-75">Rp120.000</h3>
            </div>
        </button>

    </div>
</body>

</html>