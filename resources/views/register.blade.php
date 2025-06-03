<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Register</title>

    <style>
        @media (max-width: 768px) {


            .login_ctr {
                display: block;
            }

            .login_ctr .left_side {
                width: 100%;
                height: 100vh;
            }

            .login_ctr .right_side {
                display: none;
            }

            .form_login {
                margin-left: 10px;
                margin-right: 10px;
            }

        }
    </style>
</head>

<body>
    <div class="flex h-screen login_ctr">
        {{-- Left Section --}}
        <div class="bg-[#F5F7FA] w-1/2 flex flex-col justify-center left_side">
            <div class="ml-20 flex items-center">
                <img src="img/logo.png" alt="logo" class="w-24">
                <p class="font-bold text-2xl text-[#10062B]">Pijat</p>
            </div>
            <p class="font-bold text-4xl text-[#10062B] ml-20 my-28 text-center">Daftarkan Akun Anda</p>
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

            <form method="POST" action="{{ route('auth.register.process') }}" class="mx-20 form_login">
                @csrf
                <div>
                    <input type="text" placeholder="Tuliskan nama lengkap anda"
                        class="w-full px-10 py-3 rounded-full shadow-xl" name="name" id="name"
                        value="{{ old('name') }}">
                </div>
                <div>
                    <input type="date" placeholder="Pilih tanggal lahir"
                        class="w-full px-10 py-3 rounded-full shadow-xl my-3" name="bod" id="bod"
                        value="{{ old('bod') }}">
                </div>
                <div>
                    <input type="tel" placeholder="Masukkan nomor telepon"
                        class="w-full px-10 py-3 rounded-full shadow-xl" name="phone" id="phone"
                        value="{{ old('phone') }}" pattern="[0-9]*" title="Hanya angka yang diperbolehkan">
                </div>
                <div>
                    <input type="email" placeholder="Tuliskan alamat email anda"
                        class="w-full px-10 py-3 rounded-full shadow-xl my-3" name="email" id="email"
                        value="{{ old('email') }}">
                </div>
                <div class="relative">
                    <div class="relative">
                        <input id="passwordInput" type="password" placeholder="Buat kata sandi anda"
                            class="w-full px-10 py-3 rounded-full shadow-xl" name="password">
                        <span class="absolute top-3 right-5 cursor-pointer">
                            <x-iconsax-bro-eye-slash id="eyeSlashIcon" class="w-5 text-[#5E677E]"
                                onclick="togglePasswordVisibility('passwordInput', 'eyeIcon', 'eyeSlashIcon')"
                                style="display: block;"></x-iconsax-bro-eye-slash>
                            <x-iconsax-bro-eye id="eyeIcon" class="w-5 text-[#5E677E]"
                                onclick="togglePasswordVisibility('passwordInput', 'eyeIcon', 'eyeSlashIcon')"
                                style="display: none;"></x-iconsax-bro-eye>
                        </span>
                    </div>
                </div>
                <div class="relative mt-4">
                    <div class="relative">
                        <input id="passwordConfirmationInput" type="password" placeholder="Konfirmasi kata sandi anda"
                            class="w-full px-10 py-3 rounded-full shadow-xl" name="password_confirmation">
                        <span class="absolute top-3 right-5 cursor-pointer">
                            <x-iconsax-bro-eye-slash id="eyeSlashIconConfirmation" class="w-5 text-[#5E677E]"
                                onclick="togglePasswordVisibility('passwordConfirmationInput', 'eyeIconConfirmation', 'eyeSlashIconConfirmation')"
                                style="display: block;"></x-iconsax-bro-eye-slash>
                            <x-iconsax-bro-eye id="eyeIconConfirmation" class="w-5 text-[#5E677E]"
                                onclick="togglePasswordVisibility('passwordConfirmationInput', 'eyeIconConfirmation', 'eyeSlashIconConfirmation')"
                                style="display: none;"></x-iconsax-bro-eye>
                        </span>
                    </div>
                </div>
                <button type="submit"
                    class="text-center text-white bg-[#F6AFF2] rounded-full w-full py-3 font-semibold shadow-xl mt-10">Buat
                    Akun Baru</button>
                <a href="{{ route('auth.login') }}"
                    class="text-center text-[#0E1626] bg-white rounded-full w-full py-3 font-semibold block shadow-xl mt-3">Masuk</a>
            </form>
        </div>
        {{-- Right Section --}}
        <div class="w-1/2 bg-cover bg-center relative right_side" style="background-image: url('img/bg-login.png');">
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#F6AFF2] to-transparent p-10">
                <p class="text-2xl font-semibold text-white mb-4">Spa yang menghadirkan pengalaman relaksasi terbaik
                    dengan layanan profesional dan bahan alami berkualitas.</p>
                {{-- <p class="text-sm text-white">Shayna Max</p>
                <p class="text-sm text-white">Employee at Google</p> --}}
            </div>
        </div>
    </div>

    {{-- script --}}
    <script>
        document.getElementById('phone').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Memfilter input menjadi angka saja
        });

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
</body>

</html>
