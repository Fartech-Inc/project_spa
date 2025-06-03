<div class="container mx-auto fixed z-50 left-0 right-0 top-0">
    <div class="flex justify-between items-center py-3 px-6 rounded-xl bg-white w-full mt-8 shadow relative">
        <a class="flex items-center gap-3" href="/">
            <img src="{{ asset('img/logo.png') }}" alt="logo" />
            <h1 class="font-bold text-2xl text-[#10062B]">Pijat</h1>
        </a>

        <div class="hidden md:flex gap-5 text-[#10062B]">
            <a href="/">Home</a>
            <a href="{{ route('web.services') }}" class="font-bold">Jasa</a>
        </div>

        <div class="hidden md:flex items-center gap-3">
            @auth
                <a class="bg-[#10062B] text-white rounded-full px-4 text-sm flex gap-2 py-3"
                    href="{{ route('user.profile.my_transactions') }}">
                    My Booking
                </a>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="border-2 border-[#10062B] text-[#10062B] rounded-full py-3 px-6 text-sm">Logout</button>
                </form>
            @else
                <a class="border-2 border-[#10062B] text-[#10062B] rounded-full py-3 px-6 text-sm"
                    href="{{ route('auth.login') }}">
                    Masuk
                </a>
            @endauth
        </div>

        <button id="hamburgerBtn" class="md:hidden flex items-center">
            <svg class="w-6 h-6 text-[#10062B]" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div id="mobileMenu"
            class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-md p-4 z-50 md:hidden">
            <div class="flex flex-col gap-3 text-[#10062B]">
                <a href="/" class="font-normal">Home</a>
                <a href="{{ route('web.services') }}" class="font-bold">Jasa</a>
                @auth
                    <a class="bg-[#10062B] text-white rounded-full py-2 px-4 text-sm text-center"
                        href="{{ route('user.profile.my_transactions') }}">My Booking</a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="border border-[#10062B] text-[#10062B] rounded-full py-2 px-4 text-sm text-center w-full">Logout</button>
                    </form>
                @else
                    <a class="border border-[#10062B] text-[#10062B] rounded-full py-2 px-4 text-sm text-center"
                        href="{{ route('auth.login') }}">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('hamburgerBtn');
        const menu = document.getElementById('mobileMenu');
        btn?.addEventListener('click', () => {
            menu?.classList.toggle('hidden');
        });
    });
</script>
