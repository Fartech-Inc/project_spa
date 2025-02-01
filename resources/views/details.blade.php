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
        <p>(4,389)</p>
    </div>
    <div class="grid grid-cols-3 w-max gap-10 mx-14 mt-10">
        @foreach ($service->service_galleries as $item)
            <div class="bg-white w-52 px-5 py-5 rounded-xl border">
                <img src="{{ asset('storage/' . $item->image) }}" alt="img">
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
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus sint fugiat commodi et libero dolore corporis praesentium esse cum? Enim cupiditate unde vitae fuga nisi alias qui minima eius possimus.</p>
            </div>
            <p class="font-semibold">Real Testimonials</p>
            <div class="grid grid-cols-2 gap-3">
                <x-card-testimonials></x-card-testimonials>
                <x-card-testimonials></x-card-testimonials>
                <x-card-testimonials></x-card-testimonials>
                <x-card-testimonials></x-card-testimonials>
            </div>
            <div class="flex items-center gap-5 my-5">
                <img src="img/logo.png" alt="img pp">
                <div class="border bg-white rounded-2xl p-5 w-full">              
                    <div id="rating" class="flex">
                        <label>
                            <input type="radio" name="rating" class="hidden" value="1">
                            <svg data-value="1" class="w-6 h-6 text-gray-300 hover:text-yellow-500 transition duration-200 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                        </label>
                        <label>
                            <input type="radio" name="rating" class="hidden" value="2">
                            <svg data-value="2" class="w-6 h-6 text-gray-300 hover:text-yellow-500 transition duration-200 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                        </label>
                        <label>
                            <input type="radio" name="rating" class="hidden" value="3">
                            <svg data-value="3" class="w-6 h-6 text-gray-300 hover:text-yellow-500 transition duration-200 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                        </label>
                        <label>
                            <input type="radio" name="rating" class="hidden" value="4">
                            <svg data-value="4" class="w-6 h-6 text-gray-300 hover:text-yellow-500 transition duration-200 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                        </label>
                        <label>
                            <input type="radio" name="rating" class="hidden" value="5">
                            <svg data-value="5" class="w-6 h-6 text-gray-300 hover:text-yellow-500 transition duration-200 cursor-pointer" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927a1 1 0 011.902 0l1.286 4.287a1 1 0 00.95.691h4.506c.917 0 1.303 1.169.63 1.725l-3.641 2.833a1 1 0 00-.364 1.118l1.286 4.287c.248.826-.685 1.5-1.39 1.002l-3.641-2.833a1 1 0 00-1.176 0l-3.641 2.833c-.705.498-1.638-.176-1.39-1.002l1.286-4.287a1 1 0 00-.364-1.118L2.56 9.63c-.674-.556-.287-1.725.63-1.725h4.506a1 1 0 00.95-.691L9.049 2.927z"></path>
                            </svg>
                        </label>
                    </div>
                    <input class="w-full mt-3 border rounded-lg px-2 py-3" type="text" placeholder="Tambahkan Komentar...">
                </div>
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
            <a href="{{ route('web.services') }}">Explore All</a>
        </div>
        {{-- <a href="">
            <x-card-home :services="$services"></x-card-home>
        </a> --}}
        <div class="flex flex-wrap gap-4">
            @foreach($services as $service)
                <a href="{{ route('web.service', $service->id) }}" class="w-1/3">
                    <x-card-home :services="[$service]" />
                </a>
            @endforeach
        </div>
    </div>
    <x-footer></x-footer>
</body>

<script>
    const stars = document.querySelectorAll('#rating svg');
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
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
</script>
</html>