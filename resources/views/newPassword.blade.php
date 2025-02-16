<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | New password</title>
    <script>
        function togglePasswordVisibility(inputId, eyeIconId, eyeSlashIconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(eyeIconId);
            const eyeSlashIcon = document.getElementById(eyeSlashIconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            } else {
                passwordInput.type = 'password';
                eyeIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            }
        }
    </script>

</head>

<body>
    <div class="flex h-screen">
        {{-- Left Section --}}
        <div class="bg-[#F5F7FA] w-1/2 flex flex-col justify-center">
            <div class="ml-20 flex items-center">
                <img src="img/logo.png" alt="logo" class="w-24">
                <p class="font-bold text-2xl text-[#10062B]">Pijat</p>
            </div>
            <p class="font-bold text-2xl text-[#10062B] ml-20 my-28">New Password</p>
            @if (session('success'))
                <div class="bg-green-100 text-green-600 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.newPassword') }}" method="POST" class="mx-20">
                @csrf
                <input type="hidden" name="email" value="{{ session('reset_email') }}">

                <div>
                    <p class="text-[#10062B] font-semibold">Enter New Password</p>
                    <input id="passwordInput" type="password" placeholder="Write your new Password"
                        class="w-full px-5 py-3 rounded-full shadow-xl" name="password">
                    <span class="absolute top-3 right-5 cursor-pointer">
                        <x-iconsax-bro-eye-slash id="eyeSlashIcon1" class="w-5 text-[#5E677E]"
                            onclick="togglePasswordVisibility('passwordInput', 'eyeIcon1', 'eyeSlashIcon1')"
                            style="display: block;"></x-iconsax-bro-eye-slash>
                        <x-iconsax-bro-eye id="eyeIcon1" class="w-5 text-[#5E677E]"
                            onclick="togglePasswordVisibility('passwordInput', 'eyeIcon1', 'eyeSlashIcon1')"
                            style="display: none;"></x-iconsax-bro-eye>
                    </span>
                </div>

                <div class="relative mt-5">
                    <p class="text-[#10062B] font-semibold">Confirm Password</p>
                    <div class="relative">
                        <input id="confirmPasswordInput" type="password" placeholder="Input your password again"
                            class="w-full px-5 py-3 rounded-full shadow-xl" name="password_confirmation">
                        <span class="absolute top-3 right-5 cursor-pointer">
                            <x-iconsax-bro-eye-slash id="eyeSlashIcon2" class="w-5 text-[#5E677E]"
                                onclick="togglePasswordVisibility('confirmPasswordInput', 'eyeIcon2', 'eyeSlashIcon2')"
                                style="display: block;"></x-iconsax-bro-eye-slash>
                            <x-iconsax-bro-eye id="eyeIcon2" class="w-5 text-[#5E677E]"
                                onclick="togglePasswordVisibility('confirmPasswordInput', 'eyeIcon2', 'eyeSlashIcon2')"
                                style="display: none;"></x-iconsax-bro-eye>
                        </span>
                    </div>
                </div>

                <button type="submit"
                    class="text-center text-white bg-[#F6AFF2] rounded-full w-full py-3 font-semibold my-3 shadow-xl">Submit</button>
            </form>
        </div>

        {{-- Right Section --}}
        <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('img/bg-login.png');">
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#F6AFF2] to-transparent p-10">
                <p class="text-2xl font-semibold text-white mb-4">Spa yang menghadirkan pengalaman relaksasi terbaik
                    dengan layanan profesional dan bahan alami berkualitas.</p>
            </div>
        </div>
    </div>
</body>

</html>
