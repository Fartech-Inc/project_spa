<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <x-navbar></x-navbar>

    <div class="flex items-center justify-center gap-8">
        <div class="bg-white rounded-xl p-20">
            <p class="text-4xl font-bold text-center">Booking Failed!</p>
            <p class="mb-10 mt-5">Pemesanan Mu Gagal,Coba Ulangi</p>
            <div class="flex flex-col">
                <a href="/mybooking-details" class="my-5 text-center font-semibold bg-[#FF48B6] py-3 rounded-full text-white">Back</a>
            </div>
        </div>
        <img src="img/booking-failed.png" alt="img booking failed">
    </div>

    <x-footer></x-footer>
</body>
</html>