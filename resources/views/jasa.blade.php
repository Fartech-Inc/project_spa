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
                margin: 0 12px;
                flex-direction: column;
                width: 100%;
            }

            .search_ctr .jasa_pijat_title {
                font-size: 17px;
            }

            .search_group {
                width: 100%;
            }

            .logo_img {
                width: 28px;
            }

            .pijat_logo {
                font-size: 12px;
                font-weight: 800;
                line-height: 1;
                letter-spacing: 0;
            }

            .nav_right a {
                font-size: 12px;
            }

            .card_services {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#EB85FF] via-[#FED1E7] via-10% to-white to-25%">

    <x-navbar />

    <main class="pt-40">
        <!-- Search Bar & Title -->
        <div class="flex flex-col md:flex-row items-center justify-between container mx-auto gap-4 search_ctr">
            <p class="text-4xl text-[#10062B] font-bold jasa_pijat_title">Jasa Pijat</p>
            <div class="relative mt-5 w-2/6 search_group">
                <form method="GET" action="{{ route('web.services') }}">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Temukan Pijat Anda"
                            value="{{ request()->search }}"
                            class="w-full px-5 py-3 bg-white rounded-full border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                        >
                        <button type="submit" class="absolute top-3 right-5">
                            <x-fluentui-search-48 class="w-6 text-[#5E677E]" />
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Category Section -->
         <div class="container mx-auto mt-10">

             @foreach ($service_categories as $category)
             <section class="bg-white rounded-3xl mt-10 p-6 border border-[#eee]">
                 <h2 class="text-xl font-bold text-[#0A142F] mb-6">{{ $category->name }}</h2>
                 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 card_services">
                     <x-card-jasa :services="$category->services" />
                    </div>
                </section>
                @endforeach
            </div>
            </main>

    <x-footer />

</body>

</html>
