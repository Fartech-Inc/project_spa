<footer class="bg-white mt-20 px-4 py-10">
    <div class="container mx-auto grid grid-cols-2 md:grid-cols-5 gap-8 text-sm text-[#0A142F]">
        <div>
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="mb-3 w-25" />
        </div>
        <div>
            <p class="font-bold mb-2">Learn More</p>
            <ul class="space-y-1">
                <li><a href="#">Tentang Spa</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Lingkungan</a></li>
                <li><a href="#">Hubungi Kami</a></li>
            </ul>
        </div>
        <div>
            <p class="font-bold mb-2">Tickets & Booking</p>
            <ul class="space-y-1">
                <li><a href="#">Booking Online</a></li>
                <li><a href="#">Paket Spa</a></li>
            </ul>
        </div>
        <div>
            <p class="font-bold mb-2">Contact Us</p>
            <ul class="space-y-1">
                <li>Spa Reservation: <span class="font-semibold">123-456-7890</span></li>
                <li>Paket Spa: <span class="font-semibold">123-456-7890</span></li>
            </ul>
        </div>
        <div>
            <p class="font-bold mb-2">Social</p>
            <div class="flex gap-6 text-xl">
                <x-iconsax-bol-instagram class="w-5" />
                {{-- Tambahkan icon lainnya di sini jika ada --}}
            </div>
        </div>
    </div>
    <p class="text-center text-xs text-gray-400 mt-10">
        © 2024 Pijat | All Rights Reserved
    </p>
</footer>
