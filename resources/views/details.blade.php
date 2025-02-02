<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Details</title>
</head>
<body>
    <x-navbar></x-navbar>
    <div class="flex items-center justify-between mx-14">
        <p class="text-[#10062B] text-3xl font-bold">{{ $service->name }}</p>
        <div class="flex items-center gap-2">
            <p>({{ $testimonials->count() }})</p>
            <div class="flex">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-5 h-5 {{ $i <= round($averageRating) ? 'text-yellow-500' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                    </svg>
                @endfor
            </div>
            <p class="ml-2">{{ $averageRating }}/5</p>
        </div>
    </div>
    <div class="grid grid-cols-3 w-max gap-10 mx-14 mt-10">
        @foreach ($service->service_galleries as $item)
            <div class="bg-white w-52 px-5 py-5 rounded-xl border">
                <img src="{{ asset('storage/public/' . $item->image) }}" alt="img">
            </div>
        @endforeach
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
                <div class="my-3">
                    {!! $service->description !!}
                </div>
            </div>
            <p class="font-semibold">Real Testimonials</p>
            <div class="grid grid-cols-2 gap-3">
                @foreach ($testimonials as $testimonial)
                    <div class="bg-white border border-gray-400 w-56 p-3 rounded-xl">
                        <div class="flex gap-1 mb-2">
                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                        </div>
                        <p>{{ $testimonial->message }}</p>
                        <div class="flex items-center gap-3 my-2">
                            <img src="{{ asset($testimonial->user->image) }}" alt="pp" class="w-10 h-10 rounded-full object-cover">
                            <div class="">
                                <p class="text-sm font-semibold">{{ $testimonial->user->name }}</p>
                                <p class="text-sm">{{ $testimonial->created_at }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (Auth::user() && $is_login && $is_consuming)
                <div class="flex items-center gap-5 my-5">
                    <img src="{{ asset(Auth::user()->image) }}" alt="img pp" class="w-10 h-10 rounded-full object-cover">
                    <div class="border bg-white rounded-2xl p-5 w-full">
                        <form action="{{ route('web.store.testimonial', $service->id) }}" method="POST">
                            @csrf
                            <div id="rating" class="flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <label>
                                        <input type="radio" name="rating" class="hidden" value="{{ $i }}">
                                        <svg data-value="{{ $i }}" class="w-6 h-6 text-gray-300 hover:text-yellow-500 transition duration-200 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                            <textarea name="message" class="w-full mt-3 border rounded-lg px-2 py-3" placeholder="Tambahkan Komentar..." required></textarea>
                            <button type="submit" class="bg-[#FF48B6] px-5 py-2 mt-3 text-white rounded-lg">Kirim Testimonial</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <div class="bg-white rounded-2xl border border-gray-300 w-max p-5">
            <p class="font-semibold">Book Sekarang</p>
            <p class="font-semibold">Mulai</p>
            <p class="font-bold text-2xl">Rp{{ number_format($service->price) }}</p>
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
                <a href="{{ route('web.booking.page', $service->id) }}" class="bg-[#FF48B6] px-10 py-3 m-auto rounded-full">Booking</a>
            </div>
        </div>
    </div>
    <div>
        <div class="text-[#10062B] flex items-center justify-between mx-14 py-5 text-xl font-bold">
            <p>Jasa Kami</p>
            <a href="{{ route('web.services') }}">Explore All</a>
        </div>
        <div class="flex gap-4 mx-14 overflow-x-auto pb-5">
            @foreach ($services as $service)
                <a href="{{ route('web.service', ['id' => $service->id]) }}">
                    <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-56" style="background-image: url('{{ $service['image'] }}'); background-size: cover; background-position: center;">
                        <p class="bg-white rounded-full py-3 px-3 mt-36 font-bold text-[#10062B] text-center">{{ $service['name'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <x-footer></x-footer>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#rating svg');
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                document.querySelectorAll('input[name="rating"]').forEach((input, i) => {
                    input.checked = i === index;
                });
                stars.forEach((s, i) => {
                    s.classList.remove('text-yellow-500');
                    s.classList.add('text-gray-300');
                    if (i <= index) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-500');
                    }
                });
            });
        });
    });
</script>
</html>