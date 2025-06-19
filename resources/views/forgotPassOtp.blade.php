<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Forgot Password</title>
    <style>
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}

            
            .left_side {
                padding: 0 80px;
            }
    
            @media (max-width: 1024px) {
                .left_side {
                            padding: 0 20px;
                        }
                
                .left_side {
                    width: 100%;
                    height: 100vh;
                }
                
                .right_side {
                    display: none;
                }
                
                .form_login {
                    margin-left: 10px;
                    margin-right: 10px;
                }
            
            }
    </style>
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
        <div class="bg-[#F5F7FA] w-1/2 flex flex-col justify-center left_side">
            <div class="flex items-center">
                <img src="img/logo.png" alt="logo" class="w-24">
                <p class="font-bold text-2xl text-[#10062B]">Pijat</p>
            </div>
            <p class="font-bold text-2xl text-[#10062B] my-28">Forgot Password</p>

            @if (session('success'))
            <div class="container mx-auto">
                <div class="bg-green-100 text-green-600 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="container mx-auto">
                <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            <div class="container mx-auto">
            @endif

            @if ($errors->any())
            <div class="container mx-auto">
                <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('auth.verifyOtp') }}" method="POST">
                @csrf
                <p class="text-[#10062B] text-center mb-2">Enter 6-digit Code</p>
                <div class="flex justify-center items-center gap-2">
                    <input type="number" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 0)" max="1"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                    <input type="number" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 1)" max="1"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                    <input type="number" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 2)" max="1"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                    <input type="number" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 3)" max="1"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                    <input type="number" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" oninput="moveToNextInput(event, 4)" max="1"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                    <input type="number" maxlength="1"
                        class="otp-input w-6 h-12 text-center text-xl border border-gray-300 rounded-full"
                        name="otp[]" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;"  oninput="moveToNextInput(event, 5)" max="1"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                </div>

                <button type="submit"
                    class="text-center text-white bg-[#F6AFF2] rounded-full w-full py-3 font-semibold my-3 shadow-xl mb-20">Verify
                    OTP</button>

                <a href="{{ route('auth.register') }}"
                    class="text-center text-[#0E1626] bg-white rounded-full w-full py-3 font-semibold my-3 block shadow-xl">Create
                    Resend OTP</a>
            </form>
        </div>

        {{-- Right Section --}}
        <div class="w-1/2 bg-cover bg-center relative right_side" style="background-image: url('img/bg-login.png');">
            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#F6AFF2] to-transparent p-10">
                <p class="text-2xl font-semibold text-white mb-4">Spa yang menghadirkan pengalaman relaksasi terbaik
                    dengan layanan profesional dan bahan alami berkualitas.</p>
            </div>
        </div>
    </div>

</body>

</html>
