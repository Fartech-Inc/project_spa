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
            cursor: pointer;
        }

        .star path {
            fill: #C4CBD6;
            /* default abu */
            transition: fill 0.2s;
        }

        .star.active path {
            fill: #FFC736;
            /* kuning */
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

<body class="bg-gradient-to-b from-[#EB85FF] via-[#FED1E7] via-10% to-white to-60% font-sans">
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
            <img src="{{ asset('storage/public/' . $item->image) }}" class="rounded-2xl px-16 py-8 bg-white border border-[#eee] w-full" alt="img">
            @endforeach
        </div>

        <div class="flex flex-wrap gap-4 justify-between text-sm font-semibold mb-10">
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56" style="height: 60px;">
                <div class="aspect-square flex justify-center items-center" style="background-color: #FFC736; border-radius: 50%; padding: 0.5rem; height: 100%; width: auto;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.7299 3.51L15.4899 7.03C15.7299 7.52 16.3699 7.99 16.9099 8.08L20.0999 8.61C22.1399 8.95 22.6199 10.43 21.1499 11.89L18.6699 14.37C18.2499 14.79 18.0199 15.6 18.1499 16.18L18.8599 19.25C19.4199 21.68 18.1299 22.62 15.9799 21.35L12.9899 19.58C12.4499 19.26 11.5599 19.26 11.0099 19.58L8.01991 21.35C5.87991 22.62 4.57991 21.67 5.13991 19.25L5.84991 16.18C5.97991 15.6 5.74991 14.79 5.32991 14.37L2.84991 11.89C1.38991 10.43 1.85991 8.95 3.89991 8.61L7.08991 8.08C7.61991 7.99 8.25991 7.52 8.49991 7.03L10.2599 3.51C11.2199 1.6 12.7799 1.6 13.7299 3.51Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                Garansi Layanan Terbaik
            </div>
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56" style="height: 60px;">
                <div class="aspect-square flex justify-center items-center" style="background-color: #FFC736; border-radius: 50%; padding: 0.5rem; height: 100%; width: auto;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 10L6 12L8 14" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16 10L18 12L16 14" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13 9.66998L11 14.33" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                Bonus Minyak Aromaterapi
            </div>
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56" style="height: 60px;">
                <div class="aspect-square flex justify-center items-center" style="background-color: #FFC736; border-radius: 50%; padding: 0.5rem; height: 100%; width: auto;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.48047 18.35L10.5805 20.75C10.9805 21.15 11.8805 21.35 12.4805 21.35H16.2805C17.4805 21.35 18.7805 20.45 19.0805 19.25L21.4805 11.95C21.9805 10.55 21.0805 9.35 19.5805 9.35H15.5805C14.9805 9.35 14.4805 8.85 14.5805 8.15L15.0805 4.95C15.2805 4.05 14.6805 3.05 13.7805 2.75C12.9805 2.45 11.9805 2.85 11.5805 3.45L7.48047 9.55" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                        <path d="M2.37988 18.35V8.54999C2.37988 7.14999 2.97988 6.64999 4.37988 6.64999H5.37988C6.77988 6.64999 7.37988 7.14999 7.37988 8.54999V18.35C7.37988 19.75 6.77988 20.25 5.37988 20.25H4.37988C2.97988 20.25 2.37988 19.75 2.37988 18.35Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                Dijamin 100% Profesional
            </div>
            <div class="flex items-center gap-2 rounded-full bg-white max-w-56" style="height: 60px;">
                <div class="aspect-square flex justify-center items-center" style="background-color: #FFC736; border-radius: 50%; padding: 0.5rem; height: 100%; width: auto;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.40476 15.5264L8.93476 20.0564C10.7948 21.9164 13.8148 21.9164 15.6848 20.0564L20.0748 15.6664C21.9348 13.8064 21.9348 10.7864 20.0748 8.91637L15.5348 4.39637C14.5848 3.44637 13.2748 2.93637 11.9348 3.00637L6.93476 3.24637C4.93476 3.33637 3.34476 4.92637 3.24476 6.91637L3.00476 11.9164C2.94476 13.2664 3.45476 14.5764 4.40476 15.5264Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.73438 12.2264C11.1151 12.2264 12.2344 11.1071 12.2344 9.72636C12.2344 8.34565 11.1151 7.22636 9.73438 7.22636C8.35366 7.22636 7.23438 8.34565 7.23438 9.72636C7.23438 11.1071 8.35366 12.2264 9.73438 12.2264Z" stroke="black" stroke-width="2" stroke-linecap="round" />
                        <path d="M13.2344 17.2264L17.2344 13.2264" stroke="black" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                Tanpa Biaya Tambahan
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
                            <img src="{{ $testimonial->user->image ? asset('storage/public/' . $testimonial->user->image) : asset('img/user_default.png') }}" class="rounded-full w-10 h-10 object-cover" alt="user" />
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
                    <img src="{{ Auth::user()->image ? asset('storage/public/' . Auth::user()->image) : asset('img/user_default.png') }}" class="rounded-full w-10 h-10 object-cover" alt="user" />
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

        <section class="flex items-center gap-6" style="margin: 0 0 40px 0;">
            <div class="hidden md:block">
                <img src="{{ Auth::user()->image ? asset('storage/public/' . Auth::user()->image) : asset('img/user_default.png') }}" width="100" alt="Testimonial Profile" class="rounded-full">
            </div>
            <div class="testimonial-form bg-white p-6 rounded-xl border border-gray-200 shadow-sm" style="max-width: 700px; width: 100%;">
                <h2 class="text-xl font-bold mb-4 text-[#0A142F]">Beri Testimonial</h2>

                <!-- Rating Bintang -->
                <div class="rating flex gap-2 mb-4">
                    <!-- 5 Bintang SVG -->
                    <svg class="star" data-value="1" width="24" height="24" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0L12.2451 6.90983H19.5106L13.6327 11.1803L15.8779 18.0902L10 13.8197L4.12215 18.0902L6.36729 11.1803L0.489435 6.90983H7.75486L10 0Z" />
                    </svg>
                    <svg class="star" data-value="2" width="24" height="24" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0L12.2451 6.90983H19.5106L13.6327 11.1803L15.8779 18.0902L10 13.8197L4.12215 18.0902L6.36729 11.1803L0.489435 6.90983H7.75486L10 0Z" />
                    </svg>
                    <svg class="star" data-value="3" width="24" height="24" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0L12.2451 6.90983H19.5106L13.6327 11.1803L15.8779 18.0902L10 13.8197L4.12215 18.0902L6.36729 11.1803L0.489435 6.90983H7.75486L10 0Z" />
                    </svg>
                    <svg class="star" data-value="4" width="24" height="24" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0L12.2451 6.90983H19.5106L13.6327 11.1803L15.8779 18.0902L10 13.8197L4.12215 18.0902L6.36729 11.1803L0.489435 6.90983H7.75486L10 0Z" />
                    </svg>
                    <svg class="star" data-value="5" width="24" height="24" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 0L12.2451 6.90983H19.5106L13.6327 11.1803L15.8779 18.0902L10 13.8197L4.12215 18.0902L6.36729 11.1803L0.489435 6.90983H7.75486L10 0Z" />
                    </svg>
                </div>

                <!-- Komentar -->
                <textarea
                    id="testimonial-comment"
                    placeholder="Tulis pengalaman Anda di sini..."
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-pink-400"
                    rows="4"></textarea>

                <!-- Tombol Kirim -->
                <button
                    onclick="submitTestimonial()"
                    class="bg-pink-500 text-white text-sm px-6 py-2 rounded-full mt-4 hover:bg-pink-600 transition">
                    Kirim Testimonial
                </button>
            </div>
        </section>


        <div class="mb-20">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-[#0A142F]">Jasa Kami</h2>
                <a href="{{ route('web.services') }}" class="text-sm font-semibold text-[#0A142F]">Explore All</a>
            </div>
            <div class="flex gap-4 overflow-x-auto pb-5 card_services">
                @foreach ($services as $srv)
                @php
                $thumb = $srv->service_galleries->firstWhere('is_thumbnail', true);
                $img = $thumb ? asset('storage/public/' . $thumb->image) : asset('img/massage.png');
                @endphp
                <a href="{{ route('web.service', $srv->id) }}">
                    <div class="rounded-2xl p-2 flex items-end justify-center w-56 aspect-square" style="background: url('{{ $img }}'); background-repeat: no-repeat; background-size: cover;">
                        <p class="bg-white text-center py-2 rounded-full font-semibold w-full text-sm" style="overflow: hidden;
                                display: -webkit-box;
                                -webkit-line-clamp: 1;
                                        line-clamp: 1; 
                                -webkit-box-orient: vertical;">
                            {{ Str::limit($service->name, 15) }}
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
<script>
    let currentRating = 0;

    const stars = document.querySelectorAll('.star');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            currentRating = index + 1;
            updateStarColors();
        });
    });

    function updateStarColors() {
        stars.forEach((star, index) => {
            if (index < currentRating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }

    function submitTestimonial() {
        const comment = document.getElementById('testimonial-comment').value;
        console.log('Rating:', currentRating);
        console.log('Komentar:', comment);

        // 👉 Kirim ke backend
    }
</script>