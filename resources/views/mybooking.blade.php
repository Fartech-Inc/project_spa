<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | My Booking</title>
</head>
<body>
    <x-navbar></x-navbar>
    
    <p class="text-4xl font-bold mx-14">Booking Kamu</p>
    <!-- Flash Message untuk Success & Error -->
    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg mx-14 my-4">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);
        </script>
    @endif

    @if(session('error'))
        <div id="error-message" class="bg-red-500 text-white p-4 rounded-lg mx-14 my-4">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-message').style.display = 'none';
            }, 5000);
        </script>
    @endif
    <div class="bg-pink-100 p-10">
        @foreach($transactions as $transaction)
            <div class="bg-white shadow-lg rounded-lg p-5 mb-5 flex items-center justify-between border-l-4">
                <div>
                    <p class="text-xl font-bold">{{ $transaction->service->name }}</p>
                    <p class="text-gray-500">{{ $transaction->code }}</p>
                    <p class="text-purple-600 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 12h18m-9 9h3m-3-3h3m-3-3h3m-3-3h3m-3-3h3"></path>
                        </svg>
                        <span>{{ $transaction->day }}</span>
                        <span class="px-5">{{ $transaction->start_time }} - {{ $transaction->end_time }} {{ $transaction->end_time_am_pm }}</span>
                        <span>{{ $transaction->transaction_date }}</span>
                    </p>
                </div>
                @if ($transaction->status == 'cancel')
                    <span class="bg-gray-400 text-white px-4 py-2 rounded-lg">
                        Dibatalkan
                    </span>
                @elseif ($transaction->status == 'success')
                    <span class="bg-green-500 text-white px-4 py-2 rounded-lg">
                        Selesai
                    </span>
                @else
                    <form action="{{ route('user.profile.cancel_transaction', $transaction->id) }}" method="POST" onsubmit="return confirmCancel()">
                        @csrf
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                            Batalkan
                        </button>
                    </form>
                    <button class="bg-[#FF48B6] text-white px-4 py-2 rounded-lg" id="pay-button">
                        Bayar
                    </button>
                @endif
            </div>
        @endforeach
    </div>

    <script>
        function confirmCancel() {
            return confirm("Apakah Anda yakin ingin membatalkan transaksi ini?");
        }
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            @if(isset($transaction) && $transaction->token)
                snap.pay('{{ $transaction->token }}', {
                onSuccess: function(result){
                    window.location = '{{ route("web.booking.success", ["id" => $transaction->id]) }}';
                },
                onPending: function(result){
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function(result){
                    window.location = '{{ route("web.booking.failed") }}';
                }
                });
            @else
                alert("Transaksi tidak valid atau token tidak tersedia!");
            @endif
        };
    </script>
</body>
</html>