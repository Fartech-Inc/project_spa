<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Home</title>
</head>
<body>
    <x-navbar/>
    <header>
        <div class="bg-white rounded-full py-4 px-4 flex items-center justify-center gap-3 w-max text-[#10062B] my-16 ml-14">
            <x-iconsax-bro-crown class="w-5 h-5"/>
            <p class="">Tempat Pijat Dengan Service Yang Murah</p>
        </div>
        <div class="flex items-center justify-between gap-20">
            <div class="bg-white rounded-r-3xl py-6 pl-14 pr-1">
                <p class="text-[#D70DBFCC] text-7xl font-bold">Rasakan</p>
                <p class="text-[#D70DBFCC] text-7xl font-bold">Relaksasi dan Ketenangan</p>
                <p class="text-[#D70DBFCC] text-7xl font-bold">yang Sempurna di Spa Kami.</p>
                <p class="text-[#D70DBFCC] pt-3">spa terbaik dengan layanan premium untuk tubuh dan pikiran anda</p>
            </div>
            <img src="img/jeruk.png" alt="jeruk">
        </div>
    </header>
    <main class="bg-white">
        <div>
            <div class="text-[#10062B] flex items-center justify-between mx-14 py-5 text-xl font-bold">
                <p>Jasa Kami</p>
                <a href="{{ route('web.services') }}">Explore All</a>
            </div>
            <a href="">
                <x-card-home :services="$services"></x-card-home>
            </a>
        </div>
        <div class="mt-20">
            <p class="text-[#3E443A] text-2xl text-center">Kenapa Harus Memilih</p>
            <p class="text-[#3E443A] font-bold text-4xl text-center">Pijat</p>
            <div class="flex items-center justify-between gap-5 my-16">
                <div class="text-center">
                    <img src="img/massage-icons.png" alt="icons" class="m-auto">
                    <p class="text-2xl text-[#3E443A] py-5">Terapis Berpengalaman</p>
                    <p class="text-[#3E443A]">Kami menyediakan terapis pria dan wanita yang berpengalaman dan bersertifikat</p>
                </div>
                <div class="text-center">
                    <img src="img/thumbs-up-icons.png" alt="icons" class="m-auto">
                    <p class="text-2xl text-[#3E443A] py-5">Bersih & Higienis</p>
                    <p class="text-[#3E443A]">Semua terapis dalam keadaan sehat dan juga menerapkan protokol kesehatan</p>
                </div>
                <div class="text-center">
                    <img src="img/best-price-icons.png" alt="icons" class="m-auto">
                    <p class="text-2xl text-[#3E443A] py-5">Harga Terjangkau</p>
                    <p class="text-[#3E443A]">Kami menawarkan harga yang terjangkau dan gratis ongkir transport</p>
                </div>
            </div>
        </div>
        <div class="bg-cover bg-center h-72 flex items-center justify-center" style="background-image: url('img/bg-main1.png');">
            <p class="text-white text-4xl font-bold text-center">
                Jam Kerja<br>Setiap Hari<br>(08:00 - 23:00 WIB)
            </p>
        </div>
        <div>
            <p class="text-[#3E443A] text-3xl text-center font-bold my-20">Tentang Kami</p>
            <p class="text-[#3E443A] text-3xl font-bold ml-14">Spa Pilihan Untuk Perawatan Yang Sempurna</p>
            <img src="img/bg-main2.png" alt="bg" class="w-full mt-5 h-40 px-14">
        </div>
        <div class="flex justify-center gap-6 mt-20 px-48">
            <div class="">
                <p class="font-bold text-4xl">About Us</p>
                <p class="font-bold text-2xl my-3">Perawatan Tubuh & Pikiran yang Anda Butuhkan</p>
                <p class="text-xl leading-loose">Pijat adalah spa yang menghadirkan pengalaman relaksasi terbaik dengan layanan profesional dan bahan alami berkualitas. Kami menawarkan berbagai perawatan, mulai dari pijat tradisional hingga perawatan tubuh dan wajah, untuk membantu Anda merasa lebih segar dan tenang. Temukan kenyamanan dan kedamaian bersama kami di Pijat.</p>
            </div>
            <img src="img/bg-main3.png" alt="bg" class="w-96">
        </div>
        <x-footer/>
    </main>
</body>
</html>