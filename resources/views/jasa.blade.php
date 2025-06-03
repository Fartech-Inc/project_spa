<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Services</title>
    <style>
        @media (max-width: 768px) {
            .search_ctr {
                margin-right: 12px;
                margin-left: 12px;
                flex-direction: column;
                width: 100%;
            }

            .search_ctr .jasa_pijat_title {
                font-size: 17px;
            }

            .search_group {
                width: 300px;
            }

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

            .card_services {
                display: flex;
                align-items: items-center;
                justify-content: items-center;
                flex-direction: column;
                gap: 10px;
            }

        }
    </style>
</head>

<body>
    <x-navbar></x-navbar>
    
    <div class="flex items-center justify-between mx-14 search_ctr">
        <p class="text-4xl text-[#10062B] font-bold jasa_pijat_title">Jasa Pijat</p>
        <div class="relative mt-5 w-2/6 search_group">
            <form method="GET" action="{{ route('web.services') }}">
                <div class="relative ">
                    <input type="text" name="search" placeholder="Temukan Pijat Anda"
                        class="w-full px-5 py-3 rounded-full shadow-xl" value="{{ request()->search }}">
                    <button type="submit" class="absolute top-3 right-5">
                        <x-fluentui-search-48 class="w-6 text-[#5E677E]" />
                    </button>
                </div>
            </form>
        </div>
    </div>
    @foreach ($service_categories as $category)
        <div class="grid grid-cols-3 gap-3 card_services bg-white rounded-3xl mx-14 border border-gray-500 mt-5 p-5">
            <div class="md:col-span-3 mb-5">
                <h1 class="text-3xl font-bold text-[#10062B]">{{ $category->name }}</h1>
            </div>
            <x-card-jasa :services="$category->services" />
        </div>
    @endforeach
    <x-footer></x-footer>
</body>

</html>
