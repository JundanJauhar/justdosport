<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<style>
* {
    scroll-behavior: smooth;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

#formModal {
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}
</style>

<body>
    <nav class="bg-none fixed w-full z-20 dark:border-gray-600" id='navbar'>
        <div class=" flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../assets/logo.png" class="h-10 w-10" alt="Logo" />
                <span class="text-white self-center text-xl font-semibold whitespace-nowrap dark:text-white">Just do
                    Sport
                </span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button" id='regist-button'
                    class="mr-2 text-white focus:ring-4 focus:outline-none  font-medium rounded-sm text-sm px-4 py-2 text-center ">
                    Daftar
                </button>
                <button type="button" id='login-button'
                    class="text-gray-700 bg-white focus:ring-4 focus:outline-none font-medium rounded-sm text-sm px-4 py-2 text-center ">
                    Masuk
                </button>
                <div class="modal" id='login-modal'>
                    <form class="max-w-sm mx-auto rounded-md mt-28 p-4" id='formModal'>
                        <div class="mb-5">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-white dark:text-white">Email</label>
                            <input type="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="email@example.com" required />
                        </div>
                        <div class="mb-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-white dark:text-white">
                                Password</label>
                            <input type="password" id="password" placeholder='*********'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div class="flex items-start">


                        </div>
                        <button type="submit"
                            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Masuk</button>
                    </form>

                </div>
                <div class="modal" id='regist-modal'>
                    <form class="max-w-sm mx-auto rounded-md mt-28 p-4" id='formModal'>
                        <div class="mb-5">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-white dark:text-white">Email</label>
                            <input type="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="email@example.com" required />
                        </div>
                        <div class="mb-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-white dark:text-white">
                                Password</label>
                            <input type="password" id="password" placeholder='*********'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div class="flex items-start">


                        </div>
                        <button type="submit"
                            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Daftar</button>
                    </form>

                </div>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0  ">
                    <li>
                        <a href="../Pages/LandingPage.php" class="block py-2 px-3 text-white "
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="#sec-1" class="block py-2 px-3  text-white">Layanan</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white">Fitur</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-white">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

<script src="../includes/Navbar.js"></script>

</html>