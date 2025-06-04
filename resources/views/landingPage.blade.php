<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Pijat | Home</title>
    <style>
        .text-header {
            font-size: 46px;
        }

        @media (max-width: 1300px) {
            .jeruk-header {
                display: none;
            }
        }

        @media (max-width: 1024px) {
            .text-header { font-size: 2rem; }
            .logo_img { width: 28px; }
            .pijat_logo {
                font-family: Poppins;
                font-weight: 800;
                font-size: 12px;
                line-height: 100%;
            }
            .nav_right a { font-size: 12px; }
            .title_benefits { font-size: 12px; }
            .card_services_home {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <x-navbar />

    <header class="bg-[linear-gradient(to_bottom,_#EB85FF,_#FED1E7,_#F5F6FB,_#FFFFFF)] flex flex-col pt-44">
        <div class="container mx-auto flex lg:items-start items-center mb-8">
            <div class="bg-white rounded-full py-4 px-4 flex items-center justify-center gap-3 w-max text-[#10062B]">
                <x-iconsax-bro-crown class="w-5 h-5" />
                <p class="title_benefits">Tempat Pijat Dengan Service Yang Murah</p>
            </div>
        </div>

        {{-- Hero Desktop --}}
        <div class="hidden lg:flex justify-between relative">
            <div class="flex-1 flex flex-col justify-end container mx-auto pt-8">
                <div class="bg-white flex items-end w-max pl-4 pr-36 pt-2 rounded-tr-[80px] relative">
                    <div class="absolute top-0 -left-full w-full h-full bg-white"></div>
                    <p class="text-[#D70DBFCC] font-bold text-header">Rasakan</p>
                </div>
                <div class="bg-white max-w-4xl rounded-tr-[80px] pb-20 pt-2 pl-4 relative">
                    <div class="absolute top-0 -left-full w-full h-full bg-white"></div>
                    <div>
                        <p class="text-[#D70DBFCC] font-bold text-header">Relaksasi dan Ketenangan</p>
                        <p class="text-[#D70DBFCC] font-bold text-header">yang Sempurna di Spa Kami.</p>
                        <p class="text-[#D70DBFCC] pt-3">spa terbaik dengan layanan premium untuk tubuh dan pikiran anda</p>
                    </div>
                </div>
            </div>
            <div class="flex items-end">
                <img src="{{ asset('img/jeruk.png') }}" alt="jeruk" class="jeruk-header absolute right-0 bottom-0" />
            </div>
        </div>

        {{-- Hero Mobile --}}
        <div class="flex lg:hidden gap-20 md:items-end justify-between items-end">
            <div class="container mx-auto">
                <div class="bg-white max-w-lg rounded-tr-[80px] relative">
                    <div class="absolute top-0 -left-full w-full h-full bg-white"></div>
                    <div class="py-6 px-4">
                        <p class="text-[#D70DBFCC] font-bold text-header">Relaksasi dan Ketenangan</p>
                        <p class="text-[#D70DBFCC] font-bold text-header">yang Sempurna di Spa Kami.</p>
                        <p class="text-[#D70DBFCC] pt-3">spa terbaik dengan layanan premium untuk tubuh dan pikiran anda</p>
                    </div>
                </div>
            </div>
            <img src="{{ asset('img/jeruk.png') }}" alt="jeruk" class="jeruk-header" />
        </div>
    </header>

    <main class="bg-white">
        <div class="container mx-auto mt-4">
            <div class="text-[#10062B] flex items-center justify-between py-5 text-xl font-bold">
                <p>Jasa Kami</p>
                <a href="{{ route('web.services') }}">Explore All</a>
            </div>

            <div class="flex gap-4 overflow-x-auto pb-5 card_services_home">
                @foreach ($services as $service)
                    @php
                        $thumbnail = $service->service_galleries->firstWhere('is_thumbnail', true);
                        $imageUrl = $thumbnail ? asset('storage/' . $thumbnail->image) : asset('img/massage.png');
                    @endphp
                    <a href="{{ route('web.service', ['id' => $service->id]) }}">
                        <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-56"
                            style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;">
                            <p class="bg-white rounded-full py-3 px-3 mt-36 font-bold text-[#10062B] text-center">
                                {{ $service->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Benefits --}}
        <div class="mt-20 container mx-auto">
            <p class="text-[#3E443A] text-2xl text-center mb-8">Kenapa Harus Memilih</p>
            <p class="text-[#3E443A] font-bold text-4xl text-center">Pijat</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 my-16">
                <div class="text-center">
                    <img src="{{ asset('img/massage-icons.png') }}" alt="icons" class="m-auto" />
                    <p class="text-2xl text-[#3E443A] py-5">Terapis Berpengalaman</p>
                    <p class="text-[#3E443A]">Kami menyediakan terapis pria dan wanita yang berpengalaman dan bersertifikat</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/thumbs-up-icons.png') }}" alt="icons" class="m-auto" />
                    <p class="text-2xl text-[#3E443A] py-5">Bersih & Higienis</p>
                    <p class="text-[#3E443A]">Semua terapis dalam keadaan sehat dan juga menerapkan protokol kesehatan</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('img/best-price-icons.png') }}" alt="icons" class="m-auto" />
                    <p class="text-2xl text-[#3E443A] py-5">Harga Terjangkau</p>
                    <p class="text-[#3E443A]">Kami menawarkan harga yang terjangkau dan gratis ongkir transport</p>
                </div>
            </div>
        </div>

        {{-- Work Hour --}}
        <div class="bg-cover bg-center h-[600px] flex items-center justify-center flex-col gap-4"
            style="background-image: url('{{ asset('img/bg-main1.png') }}')">
            <p class="text-white text-4xl font-bold text-center mb-8">JAM KERJA</p>
            <p class="text-white text-4xl lg:text-6xl font-bold text-center">Setiap Hari</p>
            <p class="text-white text-4xl lg:text-6xl font-bold text-center">(08:00 - 23:00 WIB)</p>
        </div>

        {{-- Tentang Kami --}}
        <div class="container mx-auto">
            <p class="text-[#3E443A] text-3xl text-center font-bold my-20">Tentang Kami</p>
            <p class="text-[#3E443A] text-3xl font-bold">Spa Pilihan Untuk Perawatan Yang Sempurna</p>
            <img src="{{ asset('img/bg-main2.png') }}" alt="bg" class="w-full mt-5 h-[20rem] bg-cover" />
        </div>

        {{-- About Us --}}
        <div class="flex flex-col lg:flex-row justify-between gap-6 container mx-auto mt-24">
            <div class="lg:max-w-xl">
                <p class="font-bold text-4xl">About Us</p>
                <p class="font-bold text-2xl my-3">Perawatan Tubuh & Pikiran yang Anda Butuhkan</p>
                <p class="text-xl leading-loose">
                    Pijat adalah spa yang menghadirkan pengalaman relaksasi terbaik dengan layanan profesional dan bahan alami berkualitas.
                    Kami menawarkan berbagai perawatan, mulai dari pijat tradisional hingga perawatan tubuh dan wajah, untuk membantu Anda
                    merasa lebih segar dan tenang. Temukan kenyamanan dan kedamaian bersama kami di Pijat.
                </p>
            </div>
            <img src="{{ asset('img/bg-main3.png') }}" alt="bg" class="lg:w-[40%]" />
        </div>

        <x-footer />
    </main>

    <script>
        const hamburgerBtn = document.getElementById("hamburgerBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        hamburgerBtn?.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    </script>
</body>
</html>
