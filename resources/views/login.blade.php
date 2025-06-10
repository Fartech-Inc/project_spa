<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Login</title>
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
    <style>

        .left_side {
            padding: 0 80px;
        }

@media (max-width: 1024px) {
    .left_side {
                padding: 0 20px;
            }
    
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
            <div class="flex items-center" style="margin-bottom: 40px;">
                <img src="img/logo.png" alt="logo" class="w-24">
                <p class="font-bold text-2xl text-[#10062B]">Pijat</p>
            </div>
            <p class="font-bold text-2xl text-[#10062B]" style="margin: 10px 0;">Sign in to Pijat</p>
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
            <form action="{{ route('auth.login.process') }}" method="POST" class="form_login" style="margin-top: 10px;">
                @csrf
                <div>
                    <p class="text-[#10062B]">Email Address</p>
                    <input type="email" placeholder="Write your email" class="w-full px-5 py-3 rounded-full shadow-xl" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="relative mt-5">
                    <p class="text-[#10062B]">Password</p>
                    <div class="relative">
                        <input id="passwordInput" type="password" placeholder="Input your password" class="w-full px-5 py-3 rounded-full shadow-xl" name="password" id="password">
                        <span class="absolute top-3 right-5 cursor-pointer">
                            <x-iconsax-bro-eye-slash id="eyeSlashIcon" class="w-5 text-[#5E677E]" onclick="togglePasswordVisibility()" style="display: block;"></x-iconsax-bro-eye-slash>
                            <x-iconsax-bro-eye id="eyeIcon" class="w-5 text-[#5E677E]" onclick="togglePasswordVisibility()" style="display: none;"></x-iconsax-bro-eye>
                        </span>
                    </div>
                </div>
                <div class="text-right my-5">
                    <a href="/forgot-pass" class="text-[#5E677E] hover:text-[#F6AFF2] transition">Forgot my password</a>
                </div>
                <button type="submit" class="text-center text-white bg-[#F6AFF2] rounded-full w-full py-3 font-semibold my-3 shadow-xl">Sign In</button>
                <a href="{{ route('auth.register') }}" class="text-center text-[#0E1626] bg-white rounded-full w-full py-3 font-semibold my-3 block shadow-xl">Create New Account</a>
            </form>
        </div>
        {{-- Right Section --}}
        <div class="w-1/2 bg-cover bg-center relative right_side" style="background-image: url('img/bg-login.png');">
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#F6AFF2] to-transparent p-10">
                <p class="text-2xl font-semibold text-white mb-4">Spa yang menghadirkan pengalaman relaksasi terbaik dengan layanan profesional dan bahan alami berkualitas.</p>
                {{-- <p class="text-sm text-white">Shayna Max</p>
                <p class="text-sm text-white">Employee at Google</p> --}}
            </div>
        </div>
    </div>
    
</body>
</html>