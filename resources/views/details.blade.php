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
    <div class="flex items-center justify-between mx-14">
        <p class="text-[#10062B] text-3xl font-bold">Pijat Tradisional</p>
        <p>(4,389)</p>
    </div>
    <div class="grid grid-cols-3 w-max gap-10 mx-14 mt-10">
        <div class="bg-white w-52 px-5 py-5 rounded-xl border">
            <img src="img/massage.png" alt="img">
        </div>
        <div class="bg-white w-52 px-5 py-5 rounded-xl border">
            <img src="img/massage.png" alt="img">
        </div>
        <div class="bg-white w-52 px-5 py-5 rounded-xl border">
            <img src="img/massage.png" alt="img">
        </div>
    </div>
    <div class="flex items-center gap-10 justify-center my-7">
        <div class="flex items-center gap-2">
            <x-iconsax-bro-magic-star class="w-10 bg-[#FFC736] px-2 py-2 rounded-full"/>
            <p class="font-semibold">Garansi Layanan Terbaik</p>
        </div>
        <div class="flex items-center gap-2">
            <x-iconsax-bro-magic-star class="w-10 bg-[#FFC736] px-2 py-2 rounded-full"/>
            <p class="font-semibold">Garansi Layanan Terbaik</p>
        </div>
        <div class="flex items-center gap-2">
            <x-iconsax-bro-magic-star class="w-10 bg-[#FFC736] px-2 py-2 rounded-full"/>
            <p class="font-semibold">Garansi Layanan Terbaik</p>
        </div>
        <div class="flex items-center gap-2">
            <x-iconsax-bro-magic-star class="w-10 bg-[#FFC736] px-2 py-2 rounded-full"/>
            <p class="font-semibold">Garansi Layanan Terbaik</p>
        </div>
    </div>
    <div class="flex justify-center mx-14 gap-7">
        <div class="">
            <div>
                <p class="text-xl font-semibold">About Product</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus sint fugiat commodi et libero dolore corporis praesentium esse cum? Enim cupiditate unde vitae fuga nisi alias qui minima eius possimus.</p>
            </div>
            <p class="font-semibold">Real Testimonials</p>
            <div class="grid grid-cols-2 gap-3">
                <x-card-testimonials></x-card-testimonials>
                <x-card-testimonials></x-card-testimonials>
                <x-card-testimonials></x-card-testimonials>
                <x-card-testimonials></x-card-testimonials>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-300 w-max p-5">
            <p class="font-semibold">Book Sekarang</p>
            <p class="font-semibold">Mulai</p>
            <p class="font-bold text-2xl">Rp150.000</p>
            <div class="flex items-center gap-3">
                <x-fluentui-checkmark-16 class="bg-[#FF48B6] p-1 rounded-full w-6 text-white"/>
                <p class="font-semibold">Handuk Bersih dan Higienis.</p>
            </div>
            <div class="flex items-center gap-3">
                <x-fluentui-checkmark-16 class="bg-[#FF48B6] p-1 rounded-full w-6 text-white"/>
                <p class="font-semibold">Minyak aromaterapi alami.</p>
            </div>
            <div class="flex items-center gap-3">
                <x-fluentui-checkmark-16 class="bg-[#FF48B6] p-1 rounded-full w-6 text-white"/>
                <p class="font-semibold">Customer service 24/7</p>
            </div>
            <div class="flex items-center gap-3">
                <x-fluentui-checkmark-16 class="bg-[#FF48B6] p-1 rounded-full w-6 text-white"/>
                <p class="font-semibold">Layanan profesional oleh terapis berpengalaman.</p>
            </div>
            <div>
                <button class="bg-[#FF48B6] px-10 py-3 m-auto rounded-full">Booking</button>
            </div>
        </div>
    </div>
    <div>
        <div class="text-[#10062B] flex items-center justify-between mx-14 py-5 text-xl font-bold">
            <p>Jasa Kami</p>
            <a>Explore All</a>
        </div>
        <x-card-home :services="$services"></x-card-home>
    </div>
    <x-footer></x-footer>
</body>
</html>