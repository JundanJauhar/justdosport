<div class="grid grid-cols-2 ">
                    <div class=" ml-16 border-solid border-2 border-gray-300 p-5 w-[450px] h-[350px]">
                        <div>
                            <h1 class="text-[20px] mb-5 font-bold">Detail Customer</h1>
                            <div class="flex">
                                <div>
                                    <div class="flex gap-4">
                                        <div>
                                            <label for="lname">Nama:</label><br>
                                            <input type="text" id="lname" name="lname" class=" border-solid border-2 h-8 border-gray-300" placeholder=""><br><br>
                                        </div>
                                        <div>
                                            <label for="phone">No Telp:</label><br>
                                            <input type="text" id="phone" name="phone" class=" border-solid border-2 h-8 border-gray-300" placeholder=""><br><br>
                                        </div>
                                    </div>
                                    <label for="email">Email:</label><br>
                                    <input type="email" id="email" name="email" class=" border-solid border-2 h-8 w-full border-gray-300" placeholder=""><br><br>
                                    <label for="remarks">Keterangan:</label><br>
                                    <input type="text" id="remarks" name="remarks" class=" border-solid border-2 h-8 border-gray-300 w-full" placeholder=""><br><br>
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class=" border-solid border-2 border-gray-300 p-5 w-[550px] h-[650px] ">
                        <div>
                            <h1 class="text-[20px] font-bold">Pilih Jenis Pembayaran</h1>
                            <h3 class="mb-5 text-gray-400">Semua transaksi yang dilakukan aman dan terenkripsi</h3>
                            <div class=" grid gap-5 p-5">
                                <div class="">
                                    <div>
                                        <h1 for="lname" class=" bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2 ">Transfer Virtual Akun</h1>
                                    </div>
                                    <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                        <button type="button" class="payment-method" data-method="bni">
                                            <img src="..\assets\bni.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="bri">
                                            <img src="..\assets\bri.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="mandiri">
                                            <img src="..\assets\mandiri.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="bca">
                                            <img src="..\assets\bca.jpeg" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <h1 for="lname" class=" bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2">e-Wallets</h1>
                                    </div>
                                    <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                        <button type="button" class="payment-method" data-method="dana">
                                            <img src="..\assets\dana.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="gopay">
                                            <img src="..\assets\gopay.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="ovo">
                                            <img src="..\assets\ovo.jpeg" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="qris">
                                            <img src="..\assets\qris.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="shopee">
                                            <img src="..\assets\shopee.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <h1 for="lname" class=" bg-[#D22F27] w-full h-10 pl-5 rounded-md p-2 pr-6 text-white mb-2">Credit Card Payment</h1>
                                    </div>
                                    <div class="grid grid-cols-4 gap-1 gap-y-4 ml-4">
                                        <button type="button" class="payment-method" data-method="visa">
                                            <img src="..\assets\visa.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="mastercard">
                                            <img src="..\assets\master card.png" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                        <button type="button" class="payment-method" data-method="jcb">
                                            <img src="..\assets\jcb.jpeg" alt="" class="border-solid border-gray-300 border-2 rounded-md p-2 w-[90px] h-[50px] hover:bg-sky-700">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>