<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | My Booking</title>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-b from-[#EB85FF] via-[#FED1E7] via-30% to-white to-70% font-sans">

    <div class="flex-1">
        <x-navbar />

        <p class="text-4xl font-bold container mx-auto mt-40">Booking Kamu</p>
    
        {{-- Flash Message --}}
        @if(session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg container mx-auto my-4">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => document.getElementById('success-message').style.display = 'none', 3000);
            </script>
        @endif
    
        @if(session('error'))
            <div id="error-message" class="bg-red-500 text-white p-4 rounded-lg container mx-auto my-4">
                {{ session('error') }}
            </div>
            <script>
                setTimeout(() => document.getElementById('error-message').style.display = 'none', 5000);
            </script>
        @endif
    
        <div class="container mx-auto mt-10">
            @foreach($transactions as $transaction)
                <div class="bg-white shadow-lg rounded-lg p-5 mb-5 flex flex-wrap gap-4 items-center justify-between border-l-4 border-pink-400">
                    <div class="flex gap-4 items-center flex-wrap">
                        <div>
                            <img src="{{ $transaction->service->image ?? asset('img/detailsJasa.png') }}" alt="booking img" class="w-32 aspect-auto">
                        </div>
                        <div class="flex flex-col">
                            <p class="text-xl font-bold">{{ $transaction->service->name }}</p>
                            <p class="text-gray-500">{{ $transaction->code }}</p>
                            <p class="text-[#FF48B6] font-medium flex items-center mt-4 flex-wrap">
                                <span>{{ $transaction->day }}</span>
                                <span class="px-5">{{ $transaction->start_time }} - {{ $transaction->end_time }} {{ $transaction->end_time_am_pm }}</span>
                                <span>{{ $transaction->transaction_date }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        @if ($transaction->status == 'cancel')
                            <span class="bg-gray-400 text-white px-4 py-2 rounded-lg">Dibatalkan</span>
                        @elseif ($transaction->status == 'success')
                            <span class="bg-green-500 text-white px-4 py-2 rounded-lg">Selesai</span>
                        @else
                            <form action="{{ route('user.profile.cancel_transaction', $transaction->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Batalkan</button>
                            </form>
                            <button
                                class="bg-[#FF48B6] text-white px-4 py-2 rounded-lg"
                                onclick="bayar('{{ $transaction->token }}', '{{ route('web.booking.success', ['id' => $transaction->id]) }}')"
                            >Bayar</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-footer />

    {{-- Midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        function bayar(token, successUrl) {
            if (!token) return alert("Token pembayaran tidak tersedia.");

            snap.pay(token, {
                onSuccess: function(result) {
                    window.location.href = successUrl;
                },
                onPending: function(result) {
                    console.log("Menunggu pembayaran...", result);
                },
                onError: function(result) {
                    window.location.href = "{{ route('web.booking.failed') }}";
                }
            });
        }
    </script>
</body>
</html>
