<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Forgot Password</title>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

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
            <p class="font-bold text-2xl text-[#10062B] ml-20 my-28">Forgot Password</p>
            {{-- @if (session('success'))
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
            @endif --}}
            <form action="{{ route('auth.sendOtp') }}" method="POST" class="mx-20">
                @csrf
                <div>
                    <p class="text-[#10062B] mb-2">Email Address</p>
                    <input type="email" placeholder="Write your email" class="w-full px-5 py-3 rounded-full shadow-xl"
                        name="email" id="email" value="{{ old('email') }}">
                </div>
                <button type="submit"
                    class="text-center text-white bg-[#F6AFF2] rounded-full w-full py-3 font-semibold my-3 shadow-xl">Send
                    OTP</button>
                <div class="flex items-center justify-center">
                    <a href="/login" class="my-5 hover:text-[#F6AFF2] hover:underline transition">Back To Sign</a>
                </div>
            </form>
        </div>
        {{-- Right Section --}}
        <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('img/bg-login.png');">
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#F6AFF2] to-transparent p-10">
                <p class="text-2xl font-semibold text-white mb-4">Spa yang menghadirkan pengalaman relaksasi terbaik
                    dengan layanan profesional dan bahan alami berkualitas.</p>
                {{-- <p class="text-sm text-white">Shayna Max</p>
                <p class="text-sm text-white">Employee at Google</p> --}}
            </div>
        </div>
    </div>

</body>

</html>
