<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Forgot Password</title>
    <script>
        function moveToNextInput(event, currentInputIndex) {
            const inputs = document.querySelectorAll('.otp-input');
            const maxIndex = inputs.length - 1;

            if (event.inputType === "deleteContentBackward" && currentInputIndex > 0) {
                inputs[currentInputIndex].value = "";
                inputs[currentInputIndex - 1].focus();
            } else if (event.target.value.length === 1 && currentInputIndex < maxIndex) {
                inputs[currentInputIndex + 1].focus();
            }
        }

        // Validasi agar hanya angka yang bisa dimasukkan
        function validateInput(event) {
            const value = event.target.value;
            if (value && !/^\d$/.test(value)) {
                event.target.value = ""; // Reset jika bukan angka
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

            <form action="{{ route('auth.verifyOtp') }}" method="POST" class="mx-20">
                @csrf
                <p class="text-[#10062B] text-center mb-2">Enter 6-digit Code</p>
                <div class="flex justify-center items-center gap-2">
                    <input type="text" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 0)" oninput="validateInput(event)" />
                    <input type="text" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 1)" oninput="validateInput(event)" />
                    <input type="text" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 2)" oninput="validateInput(event)" />
                    <input type="text" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 3)" oninput="validateInput(event)" />
                    <input type="text" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 4)" oninput="validateInput(event)" />
                    <input type="text" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 5)" oninput="validateInput(event)" />
                </div>

                <button type="submit"
                    class="text-center text-white bg-[#F6AFF2] rounded-full w-full py-3 font-semibold my-3 shadow-xl mb-20">Verify
                    OTP</button>

                <a href="{{ route('auth.register') }}"
                    class="text-center text-[#0E1626] bg-white rounded-full w-full py-3 font-semibold my-3 block shadow-xl">Create
                    New Account</a>
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
