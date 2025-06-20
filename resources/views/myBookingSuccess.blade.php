<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite('resources/css/app.css')
    <title>Booking Success</title>
</head>

<body class="bg-gradient-to-b from-[#EB85FF] via-[#FED1E7] via-40% to-white to-90% font-sans min-h-screen">

    <x-navbar />

    <!-- Main Content -->
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 items-center justify-center gap-8 min-h-screen py-44 lg:py-0">
        <div class="bg-white rounded-[2rem] p-8 max-w-md w-full shadow">
            <p class="text-2xl text-center font-bold mb-4">Booking Finished!</p>
            <p class="mb-2">Booking ID</p>
            <div class="mb-8 flex items-center gap-3 border-2 border-[#eee] rounded-full py-2 px-4 w-full">
                <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 10V7C4.5 6.44772 4.94772 6 5.5 6H7.3125M4.5 10V20C4.5 20.5523 4.94772 21 5.5 21H18.5C19.0523 21 19.5 20.5523 19.5 20V10M4.5 10H19.5M19.5 10V7C19.5 6.44772 19.0523 6 18.5 6H16.2188M7.3125 6V3M7.3125 6H16.2188M16.2188 6V3" stroke="#FF48B6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 14L16 14" stroke="#FF48B6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p class="font-bold">#{{ $code }}</p>
            </div>
            <p>Gunakan kode booking di atas untuk memeriksa status pemesananmu</p>
            <div class="flex flex-col">
                <a href="{{ route('web.services') }}" class="my-5 text-center font-semibold bg-[#FF48B6] py-3 rounded-full text-white">
                    Booking other packages
                </a>
                <a href="{{ route('user.profile.my_transactions') }}" class="text-center font-semibold bg-white py-3 rounded-full text-[#FF48B6] border-2 border-[#FF48B6]">
                    View My booking
                </a>
            </div>
        </div>
        <img src="{{ asset('img/booking-success.png') }}" alt="booking success" class="max-w-lg w-full" />
    </div>

    <x-footer />
</body>
</html>
