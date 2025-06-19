<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Booking Details</title>
    <style>
        .additional-product:hover {
            opacity: 0.8;
        }

        .selected-product {
            border-color: #f38bbd !important;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#EB85FF] via-[#FED1E7] via-10% to-white to-50% font-sans">
    <x-navbar></x-navbar>

    @if(session('success') && isset($snapToken) && isset($transaction))
    <div id="snap-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 top-0 right-0 bottom-0 left-0 flex items-center justify-center">
        <div class="bg-white p-8 rounded-xl text-center shadow-lg w-[90%] max-w-md">
            <h2 class="text-xl font-bold mb-4">Lanjutkan Pembayaran</h2>
            <p class="mb-6">Klik tombol di bawah ini untuk membayar melalui Midtrans</p>
            <div class="flex justify-center gap-4">
                <button class="bg-pink-500 text-white px-6 py-3 rounded-full font-semibold" id="pay-button">
                    Bayar Sekarang
                </button>
                <a href="{{ route('user.profile.my_transactions') }}" class="bg-gray-300 text-black px-6 py-3 rounded-full font-semibold hover:bg-gray-400">
                    Bayar Nanti
                </a>
            </div>
        </div>
    </div>
    @endif


    <form action="{{  route('web.booking.process') }}" method="POST">
        @csrf
        <div class="max-w-5xl mx-auto px-4 py-40">
            <h1 class="text-2xl font-bold mb-6">Booking {{ $code }}</h1>
            <input type="hidden" name="code" value="{{ $code }}">

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Terjadi Kesalahan!</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Pesanan Section -->
            <div class="bg-white rounded-xl p-6 shadow mb-6">
                <p class="font-semibold mb-4">Pesanan</p>
                <div class="flex items-center flex-wrap gap-4 justify-between border border-gray-200 rounded-xl p-4">
                    <div class="flex items-center gap-4">
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <img src="{{ $service->image }}" alt="img" class="rounded-xl w-20 h-20 object-cover">
                        <div>
                            <p class="font-semibold">{{ $service->name }}</p>
                            <p class="text-pink-500 font-semibold">Rp{{ number_format($service->price) }}</p>
                        </div>
                    </div>
                    <button class="px-6 py-2 border border-black rounded-full text-sm font-semibold">Deposit</button>
                    <input type="hidden" name="payment_type" value="down_payment">
                </div>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="bg-white rounded-xl p-6 shadow mb-6">
                <p class="font-semibold mb-4">Informasi Pelanggan</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="flex flex-col gap-2">
                        <label>Nama Lengkap</label>
                        <div class="flex items-center gap-2 border-2 border-[#eee] rounded-full px-4 py-2">
                            <span class="font-semibold">{{ $user->name }}</span>
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="name" value="{{ $user->name }}">
                        </div>
                        <label>Nomor Telepon</label>
                        <div class="flex items-center gap-2 border-2 border-[#eee] rounded-full px-4 py-2">
                            <span class="font-semibold">{{ $user->phone }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label>Alamat Email</label>
                        <div class="flex items-center gap-2 border-2 border-[#eee] rounded-full px-4 py-2">
                            <span class="font-semibold">{{ $user->email }}</span>
                        </div>
                        <label>Mulai Pada</label>
                        <div class="flex items-center gap-2 border-2 border-[#eee] rounded-full px-4 py-2">
                            <input type="date" class="w-full bg-transparent" name="transaction_date" required value="{{ old('transaction_date') }}">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label>Waktu Pemesanan</label>
                    <div class="flex items-center gap-2 border-2 border-[#eee] rounded-full px-4 py-2">
                        <input type="time" class="bg-transparent" name="start_time" value="{{ old('start_time') }}" required>
                        <span>-</span>
                        <input type="time" class="bg-transparent" name="end_time" value="{{ old('end_time') }}" required>
                    </div>
                </div>
            </div>

            <!-- Tambahan Produk Section -->
            <div class="bg-white rounded-xl p-6 shadow mb-6">
                <p class="font-semibold mb-4">Tambahan Produk</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                    <button type="button" class="additional-product border-2 border-[#eee] rounded-xl p-4 shadow text-center" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                        <img src="{{ '/storage/public/' . $product->image }}" class="mx-auto mb-2" />
                        <p class="font-semibold">{{ $product->name }}</p>
                        <p class="text-gray-500 text-sm">{{ $product->product_category->name }}</p>
                        <p class="text-blue-600 font-semibold">Rp{{ number_format($product->price) }}</p>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Payment Details -->
            <div class="bg-white rounded-xl p-6 shadow mb-6">
                <p class="font-semibold mb-4">Payment Details</p>
                <div class="flex justify-between flex-wrap gap-2">
                    <div class="font-bold">{{ $service->name }} <span class="italic font-normal">Rp{{ number_format($service->price) }}</span></div>
                    <div id="selected-products">
                        <p class="text-gray-500 italic">Tidak ada produk tambahan yang dipilih</p>
                    </div>
                </div>
                <div class="flex justify-between flex-wrap gap-2 mt-4">
                    <span class="font-bold">Consultation & Insurance</span>
                    <span class="font-bold text-sm">Rp. 0 (Free)</span>
                </div>
                <div class="flex justify-between flex-wrap gap-2 mt-4">
                    <span class="font-bold">Grand Total Amount</span>
                    <span class="font-bold text-pink-500 text-xl" id="total-price">Rp{{ number_format($service->price) }}</span>
                    <input type="hidden" name="total_price" value="{{ $service->price }}">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-pink-500 text-white font-semibold w-full py-3 rounded-full">Bayar</button>
            </div>
        </div>
    </form>

    <x-footer></x-footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedProducts = [];
            let servicePrice = parseInt("{{ $service->price }}");
            let totalPrice = servicePrice;

            $(".additional-product").on("click", function() {
                let productId = $(this).data("id");
                let productName = $(this).data("name");
                let productPrice = parseInt($(this).data("price"));
                let index = selectedProducts.findIndex(p => p.id === productId);

                if (index === -1) {
                    selectedProducts.push({
                        id: productId,
                        name: productName,
                        price: productPrice
                    });
                    totalPrice += productPrice;
                    $(this).addClass("border-[#EB85FF]");
                } else {
                    selectedProducts.splice(index, 1);
                    totalPrice -= productPrice;
                    $(this).removeClass("border-[#EB85FF]");
                }

                updateSelectedProducts();
                updateTotalPrice();
            });

            function updateSelectedProducts() {
                let container = $("#selected-products");
                container.empty();
                if (selectedProducts.length === 0) {
                    container.append(`<p class="text-gray-500 italic">Tidak ada produk tambahan yang dipilih</p>`);
                } else {
                    selectedProducts.forEach(product => {
                        container.append(`<div class="flex items-center gap-2">
                            <p class="font-bold text-sm">${product.name}</p>
                            <p class="italic text-sm">Rp${product.price.toLocaleString()}</p>
                            <input type="hidden" name="product_id[]" value="${product.id}">
                        </div>`);
                    });
                }
            }

            function updateTotalPrice() {
                $("#total-price").text(`Rp${totalPrice.toLocaleString()}`);
                $("input[name='total_price']").val(totalPrice);
            }
        });

        document.querySelectorAll('.additional-product').forEach(button => {
            button.addEventListener('click', () => {
                // Toggle aktif
                button.classList.toggle('selected-product');

                // (Opsional) Jika hanya boleh pilih satu:
                // document.querySelectorAll('.additional-product').forEach(b => b.classList.remove('selected-product'));
                // button.classList.add('selected-product');

                // Ambil data (kalau perlu)
                const id = button.dataset.id;
                const name = button.dataset.name;
                const price = button.dataset.price;

                console.log(`Produk dipilih: ${name} - Rp${price}`);
            });
        });
    </script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        @if(session('success') && isset($snapToken))
        $(document).ready(function() {
            $('#pay-button').on('click', function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location = '{{ route("web.booking.success", ["id" => $transaction->id]) }}';
                    },
                    onPending: function(result) {
                        console.log("Pending", result);
                    },
                    onError: function(result) {
                        window.location = '{{ route("web.booking.failed") }}';
                    }
                });
            });
        });
        @endif
    </script>
    <script>
        @if(session('success') && isset($snapToken))
        $(document).ready(function() {
            $("#snap-modal").hide().fadeIn(300);
        });
        @endif
    </script>
</body>

</html>