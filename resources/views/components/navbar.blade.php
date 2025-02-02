<div class="flex justify-between items-center mx-14 my-5 py-4 px-3 rounded-xl bg-white">
    <a class="flex items-center gap-3" href="/">
        <img src="img/logo.png" alt="logo">
        <h1 class="font-bold text-2xl text-[#10062B]">Pijat</h1>
    </a>
    <div class="flex gap-5 text-[#10062B]">
        <a href="/">Home</a>
        <a href="{{ route('web.services') }}">Jasa</a>
        {{-- <a href="">Testimonials</a> --}}
    </div>
    <div class="flex items-center gap-3 relative">
        @if (Auth::user())
            <a class="flex items-center gap-3 rounded-full bg-[#10062B] text-white py-3 px-4" href="{{ route('user.profile.my_transactions') }}">
                {{-- <x-fluentui-book-add-20-o /> --}}
                <p>My Booking</p>
            </a>
            <!-- Dropdown Toggle -->
            <div class="relative">
                <button onclick="toggleDropdown()" class="border border-[#10062B] rounded-full py-3 px-4 flex items-center gap-2" id="dropdownButton">
                    {{ Auth::user()->name }}
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 bg-white border rounded-lg shadow-lg w-48 z-50">
                    <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form action="{{ route('auth.logout') }}" method="POST" class="block">
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

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = document.getElementById('dropdownButton');

        // Check if the clicked element is not the button or the dropdown menu
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
