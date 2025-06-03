<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Home</title>
    <style>
        .text-header {
            font-size: 46px;
        }

        @media (max-width: 768px) {
            .text-header {
                font-size: 1.5rem;
            }

            .jeruk-header {
                display: none;
            }

            .logo_img {
                width: 28px;

            }

            .pijat_logo {
                font-family: Poppins;
                font-weight: 800;
                font-size: 12px;
                line-height: 100%;
                letter-spacing: 0%;
            }

            .nav_right a {
                font-size: 12px;
            }

            .title_benefits {
                font-size: 12px;
            }

            .card_services_home {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <x-navbar></x-navbar>

    <header class="bg-red-500 w-full py-32">
        <div
            class="bg-white rounded-full py-4 px-4 flex items-center justify-center gap-3 w-max text-[#10062B] my-16 container">
            <x-iconsax-bro-crown class="w-5 h-5" />
            <p class="title_benefits">Tempat Pijat Dengan Service Yang Murah</p>
        </div>
        <div class="flex items-center justify-between gap-20">
            <div class="bg-white rounded-r-3xl py-6 pl-14 pr-1">
                <p class="text-[#D70DBFCC] font-bold text-header">Rasakan</p>
                <p class="text-[#D70DBFCC] font-bold text-header">Relaksasi dan Ketenangan</p>
                <p class="text-[#D70DBFCC] font-bold text-header">yang Sempurna di Spa Kami.</p>
                <p class="text-[#D70DBFCC] pt-3">spa terbaik dengan layanan premium untuk tubuh dan pikiran anda</p>
            </div>
            <img src="img/jeruk.png" alt="jeruk" class="jeruk-header md:w-[28px]">
        </div>
    </header>
    <main class="bg-white">
        <div>
            <div class="text-[#10062B] flex items-center justify-between mx-14 py-5 text-xl font-bold">
                <p>Jasa Kami</p>
                <a href="{{ route('web.services') }}">Explore All</a>
            </div>
            {{-- <a href="">
                <x-card-home :services="$services"></x-card-home>
            </a> --}}
            <div class="flex gap-4 mx-14 overflow-x-auto pb-5 card_services_home">
                <!-- @foreach ($services as $service)
<a href="{{ route('web.service', ['id' => $service->id]) }}">
                    <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-56" style="background-image: url('{{ $service['image'] }}'); background-size: cover; background-position: center;">
                        <p class="bg-white rounded-full py-3 px-3 mt-36 font-bold text-[#10062B] text-center">{{ $service['name'] }}</p>
                    </div>
                </a>
@endforeach -->
                <!-- @foreach ($services as $service)
@if ($service->service_galleries->isNotEmpty())
<a href="{{ route('web.service', ['id' => $service->id]) }}">
                    <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-56"
                        style="background-image: url('{{ asset('storage/' . $service->service_galleries->first()->image) }}');">
                        <p class="bg-white rounded-full py-3 px-3 mt-36 font-bold text-[#10062B] text-center">{{ $service->name }}</p>
                    </div>
                </a>
@endif
@endforeach -->
                @foreach ($services as $service)
                    <a href="{{ route('web.service', ['id' => $service->id]) }}">
                        @php
                            $thumbnail = $service->service_galleries->firstWhere('is_thumbnail', true);
                            $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->image) : asset('img/massage.png');
                        @endphp
                        <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-56"
                            style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;">
                            <p class="bg-white rounded-full py-3 px-3 mt-36 font-bold text-[#10062B] text-center">
                                {{ $service->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="mt-20">
            <p class="text-[#3E443A] text-2xl text-center">Kenapa Harus Memilih</p>
            <p class="text-[#3E443A] font-bold text-4xl text-center">Pijat</p>
            <div class="md:flex md:justify-center md:items-center gap-5 my-16 mx-20">
                <div class="text-center">
                    <img src="img/massage-icons.png" alt="icons" class="m-auto">
                    <p class="text-2xl text-[#3E443A] py-5">Terapis Berpengalaman</p>
                    <p class="text-[#3E443A]">Kami menyediakan terapis pria dan wanita yang berpengalaman dan
                        bersertifikat</p>
                </div>
                <div class="text-center">
                    <img src="img/thumbs-up-icons.png" alt="icons" class="m-auto">
                    <p class="text-2xl text-[#3E443A] py-5">Bersih & Higienis</p>
                    <p class="text-[#3E443A]">Semua terapis dalam keadaan sehat dan juga menerapkan protokol kesehatan
                    </p>
                </div>
                <div class="text-center">
                    <img src="img/best-price-icons.png" alt="icons" class="m-auto">
                    <p class="text-2xl text-[#3E443A] py-5">Harga Terjangkau</p>
                    <p class="text-[#3E443A]">Kami menawarkan harga yang terjangkau dan gratis ongkir transport</p>
                </div>
            </div>
        </div>
        <div class="bg-cover bg-center h-72 flex items-center justify-center"
            style="background-image: url('img/bg-main1.png');">
            <p class="text-white text-4xl font-bold text-center">
                Jam Kerja<br>Setiap Hari<br>(08:00 - 23:00 WIB)
            </p>
        </div>
        <div>
            <p class="text-[#3E443A] text-3xl text-center font-bold my-20">Tentang Kami</p>
            <p class="text-[#3E443A] text-3xl font-bold ml-14">Spa Pilihan Untuk Perawatan Yang Sempurna</p>
            <img src="img/bg-main2.png" alt="bg" class="w-full mt-5 h-[20rem] px-14 bg-cover">
        </div>
        <div class="md:flex md:justify-center gap-6 mt-[20rem] px-14 mt-20">
            <div class="">
                <p class="font-bold text-4xl">About Us</p>
                <p class="font-bold text-2xl my-3">Perawatan Tubuh & Pikiran yang Anda Butuhkan</p>
                <p class="text-xl leading-loose">Pijat adalah spa yang menghadirkan pengalaman relaksasi terbaik dengan
                    layanan profesional dan bahan alami berkualitas. Kami menawarkan berbagai perawatan, mulai dari
                    pijat tradisional hingga perawatan tubuh dan wajah, untuk membantu Anda merasa lebih segar dan
                    tenang. Temukan kenyamanan dan kedamaian bersama kami di Pijat.</p>
            </div>
            <img src="img/bg-main3.png" alt="bg" class="w-96">
        </div>
        <div class="mx-14">

            <x-footer />
        </div>
    </main>

</body>

</html>
