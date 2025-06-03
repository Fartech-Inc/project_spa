<div class="z-[100000] flex justify-between items-center mx-14 my-5 py-4 px-3 rounded-xl bg-white">
    <a class="flex items-center gap-3" href="/">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo_img">
        <h1 class="font-bold text-2xl text-[#10062B] pijat_logo">Pijat</h1>
    </a>

    <div class="flex gap-5 text-[#10062B] nav_right">
        <a href="{{ route('web.services') }}">Jasa</a>
    </div>

    <div class="flex items-center gap-3 relative">
        @if (Auth::user())
            <a class="flex items-center gap-3 rounded-full bg-[#10062B] text-white py-3 px-4" href="{{ route('user.profile.my_transactions') }}">
                <p>My Booking</p>
            </a>

            <div class="relative">
                <button id="dropdownButton" class="border border-[#10062B] rounded-full py-3 px-4 flex items-center gap-2">
                    {{ Auth::user()->name }}
                </button>

                <div id="dropdownMenu" class="hidden z-[100000] absolute right-0 mt-2 bg-white border rounded-lg shadow-lg w-48">
                    <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <a class="border border-[#10062B] rounded-full py-3 px-4" href="{{ route('auth.login') }}">Masuk</a>
        @endif
    </div>
</div>

<!-- Script langsung di dalam komponen -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('dropdownButton');
        const dropdown = document.getElementById('dropdownMenu');

        if (button && dropdown) {
            button.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
    });
</script>
