<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Details</title>
    <style>
        .star {
            width: 24px;
            height: 24px;
            fill: gray;
            cursor: pointer;
            transition: fill 0.2s ease-in-out;
        }

        .star.active,
        .star.full {
            fill: gold;
        }

        .star.half {
            fill: url(#halfGradient);
        }

        @media (max-width: 768px) {
            .benefits_ctr {
                flex-direction: column;
            }

            .about_product_ctr {
                margin-left: 10px;
                margin-right: 10px;
                flex-direction: column;
            }

            .book_now_ctr {
                height: max-content;
                width: 100%;
            }

            .book_btn {
                width: 100%;
                color: white;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#EB85FF] via-[#FED1E7] via-10% to-white to-25% font-sans">
    <x-navbar></x-navbar>

    <main class="pt-40 container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 mx-4 md:mx-0">
            <h1 class="text-3xl font-bold text-[#0A142F]">{{ $service->name }}</h1>
            <div class="flex items-center gap-2">
                <p class="text-yellow-400 text-lg">@for($i = 0; $i < round($averageRating); $i++) ★ @endfor</p>
                <span class="text-gray-600 text-sm">({{ $testimonials->count() }})</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
            @foreach ($service->service_galleries as $item)
                <img src="{{ asset('storage/' . $item->image) }}" class="rounded-2xl px-16 py-8 bg-white border border-[#eee] w-full" alt="img">
            @endforeach
        </div>

        <div class="flex flex-wrap gap-4 justify-between text-sm font-semibold mb-10">
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56 py-2 px-4">
                <span class="bg-yellow-400 rounded-full p-2">⭐</span> Garansi Layanan Terbaik
            </div>
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56 py-2 px-4">
                <span class="bg-yellow-400 rounded-full p-2">🧴</span> Bonus Minyak Aromaterapi
            </div>
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56 py-2 px-4">
                <span class="bg-yellow-400 rounded-full p-2">👍</span> Dijamin 100% Profesional
            </div>
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56 py-2 px-4">
                <span class="bg-yellow-400 rounded-full p-2">📍</span> Tanpa Biaya Tambahan
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-10 mb-10">
            <div class="md:col-span-2">
                <h2 class="text-xl font-bold mb-3">About Product</h2>
                <p class="mb-5 text-sm text-gray-700">{!! $service->description !!}</p>

                <h2 class="text-lg font-bold mb-4">Real Testimonials</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    @foreach ($testimonials as $testimonial)
                        <div class="bg-white border-2 border-[#eee] p-4 rounded-xl">
                            <p class="text-yellow-400 mb-2">@for($i=0; $i<$testimonial->rating; $i++) ★ @endfor</p>
                            <p class="text-sm mb-2">{{ $testimonial->message }}</p>
                            <div class="flex items-center gap-3">
                                <img src="{{ $testimonial->user->image ? asset('storage/' . $testimonial->user->image) : asset('img/user_default.png') }}" class="rounded-full w-10 h-10 object-cover" alt="user" />
                                <div>
                                    <p class="font-semibold text-sm">{{ $testimonial->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $testimonial->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($is_login && $is_consuming && !$is_already_testimonial)
                    <form action="{{ route('web.store.testimonial', $service->id) }}" method="POST" class="flex items-start gap-4 bg-white rounded-xl p-4">
                        @csrf
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('img/user_default.png') }}" class="rounded-full w-10 h-10 object-cover" alt="user" />
                        <div class="w-full">
                            <input type="number" name="rating" min="1" max="5" required class="w-full border-2 border-[#eee] rounded-xl px-3 py-2 text-sm mb-2" placeholder="Rating (1-5)" />
                            <textarea name="message" class="w-full border-2 border-[#eee] rounded-xl px-3 py-2 text-sm mb-2" placeholder="Tambahkan Komentar..." required></textarea>
                            <button class="bg-pink-500 text-white py-2 px-4 rounded-full">Kirim</button>
                        </div>
                    </form>
                @endif
            </div>

            <div class="bg-white border-2 border-[#eee] p-6 rounded-2xl self-start">
                <p class="font-semibold mb-2">Book Sekarang</p>
                <p class="text-2xl font-bold mb-4">Rp{{ number_format($service->price) }}</p>
                <ul class="space-y-3 text-sm">
                    <li class="flex gap-2 text-[#0A142F] font-semibold">✅ Handuk bersih dan higienis.</li>
                    <li class="flex gap-2 text-[#0A142F] font-semibold">✅ Minyak aromaterapi alami.</li>
                    <li class="flex gap-2 text-[#0A142F] font-semibold">✅ Customer service 24/7</li>
                    <li class="flex gap-2 text-[#0A142F] font-semibold">✅ Terapis profesional</li>
                </ul>
                <a href="{{ route('web.booking.page', $service->id) }}" class="block text-center w-full mt-5 bg-pink-500 text-white py-2 rounded-full">
                    Booking
                </a>
            </div>
        </div>

        <div class="mb-20">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-[#0A142F]">Jasa Kami</h2>
                <a href="{{ route('web.services') }}" class="text-sm font-semibold text-[#0A142F]">Explore All</a>
            </div>
            <div class="flex gap-4 overflow-x-auto pb-5 card_services">
                @foreach ($services as $srv)
                    @php
                        $thumb = $srv->service_galleries->firstWhere('is_thumbnail', true);
                        $img = $thumb ? asset('storage/' . $thumb->image) : asset('img/massage.png');
                    @endphp
                    <a href="{{ route('web.service', $srv->id) }}">
                        <div class="rounded-2xl p-2 flex items-end justify-center w-56 aspect-square" style="background: url('{{ $img }}'); background-repeat: no-repeat; background-size: cover;">
                            <p class="bg-white text-center py-2 rounded-full font-semibold w-full text-sm">
                                {{ $srv->name }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>

    <x-footer></x-footer>
</body>

</html>
