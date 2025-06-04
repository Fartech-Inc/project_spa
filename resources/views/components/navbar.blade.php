<div class="container mx-auto fixed z-50 left-0 right-0 top-0">
    <div class="flex justify-between items-center py-3 px-6 rounded-xl bg-white w-full mt-8 shadow relative">
        <a class="flex items-center gap-3" href="/">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo_img">
            <h1 class="font-bold text-2xl text-[#10062B] pijat_logo">Pijat</h1>
        </a>

        <div class="hidden md:flex gap-5 text-[#10062B] nav_right">
            <a href="/">Home</a>
            <a href="{{ route('web.services') }}" class="font-bold">Jasa</a>
        </div>

        <div class="hidden md:flex items-center gap-3 relative">
            @if (Auth::user())
                <a class="bg-[#10062B] text-white rounded-full px-4 text-sm flex gap-2 py-3" href="{{ route('user.profile.my_transactions') }}">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.6665 1.66669V4.16669" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.3335 1.66669V4.16669" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 7.08335V11.3584C16.7583 10.7667 15.8167 10.4167 14.7917 10.4167C13.7667 10.4167 12.8083 10.775 12.0583 11.3833C11.05 12.175 10.4167 13.4167 10.4167 14.7917C10.4167 15.6084 10.65 16.3917 11.05 17.0417C11.3583 17.55 11.7583 17.9917 12.2333 18.3334H6.66667C3.75 18.3334 2.5 16.6667 2.5 14.1667V7.08335C2.5 4.58335 3.75 2.91669 6.66667 2.91669H13.3333C16.25 2.91669 17.5 4.58335 17.5 7.08335Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.8335 9.16669H10.8335" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.8335 13.3333H8.01683" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19.1665 14.7917C19.1665 15.6084 18.9332 16.3917 18.5332 17.0417C18.2998 17.4417 18.0082 17.7917 17.6665 18.075C16.8998 18.7584 15.8998 19.1667 14.7915 19.1667C13.8332 19.1667 12.9498 18.8584 12.2332 18.3334C11.7582 17.9917 11.3582 17.55 11.0498 17.0417C10.6498 16.3917 10.4165 15.6084 10.4165 14.7917C10.4165 13.4167 11.0498 12.175 12.0582 11.3833C12.8082 10.775 13.7665 10.4167 14.7915 10.4167C15.8165 10.4167 16.7582 10.7667 17.4998 11.3584C18.5165 12.1584 19.1665 13.4 19.1665 14.7917Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.7918 16.875C14.7918 15.725 15.7252 14.7916 16.8752 14.7916C15.7252 14.7916 14.7918 13.8583 14.7918 12.7083C14.7918 13.8583 13.8585 14.7916 12.7085 14.7916C13.8585 14.7916 14.7918 15.725 14.7918 16.875Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    My Booking
                </a>
                <button id="dropdownButton" class="border border-[#10062B] text-[#10062B] rounded-full py-3 px-6 text-sm">
                    {{ Auth::user()->name }}
                </button>
                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 bg-white border rounded-lg shadow-lg w-48">
                    <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            @else
                <a class="border-2 border-[#10062B] text-[#10062B] rounded-full py-3 px-6 text-sm" href="{{ route('auth.login') }}">Masuk</a>
            @endif
        </div>

        <button id="hamburgerBtn" class="md:hidden flex items-center">
            <svg class="w-6 h-6 text-[#10062B]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <div id="mobileMenu" class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-md p-4 z-50 md:hidden">
            <div class="flex flex-col gap-3 text-[#10062B]">
                <a href="/" class="font-normal">Home</a>
                <a href="{{ route('web.services') }}" class="font-bold">Jasa</a>
        
                @if (Auth::user())
                    <a class="bg-[#10062B] text-white rounded-full py-2 px-4 text-sm text-center" href="{{ route('user.profile.my_transactions') }}">
                        My Booking
                    </a>
                    <a class="border border-[#10062B] text-[#10062B] rounded-full py-2 px-4 text-sm text-center" href="{{ route('user.profile') }}">
                        {{ Auth::user()->name }}
                    </a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="border border-[#10062B] text-[#10062B] rounded-full py-2 px-4 text-sm text-center w-full">
                            Logout
                        </button>
                    </form>
                @else
                    <a class="border border-[#10062B] text-[#10062B] rounded-full py-2 px-4 text-sm text-center" href="{{ route('auth.login') }}">
                        Masuk
                    </a>
                @endif
            </div>
        </div>
        
    </div>
</div>

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
