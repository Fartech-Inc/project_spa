<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Payment</title>
</head>
<body>
    <x-navbar />

    <button type="submit" class="flex justify-center items-center w-50 text-center font-semibold bg-[#FF48B6] py-3 px-5 my-5 mx-20 rounded-full text-white" id="pay-button">Bayar</button>

    <x-footer />

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