<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pijat | Booking Details</title>
</head>
<body>
    <x-navbar></x-navbar>

    <form action="{{  route('web.booking.process') }}" method="POST">
        @csrf
        <div class="flex items-center gap-3 mx-20 text-3xl font-bold my-10">
            <h1>Booking</h1>
            <p>{{ $code }}</p>
            <input type="hidden" name="code" value="{{ $code }}">
        </div>
        <div class="bg-white mx-36 rounded-xl p-10">
            <hr>
            <div class="flex items-center justify-between">
                <p class="font-bold text-xl">Pesanan</p>
                <svg fill="#FF48B6" height="1rem" width="1rem" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_224_" d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394 l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393 C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"></path> </g></svg>
            </div>
            <div class="bg-white border rounded-xl p-5 m-5 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <img src="{{ $service->image }}" alt="img" class="rounded-xl w-32">
                    <div>
                        <p class="font-bold text-xl">{{ $service->name }}</p>
                        <p class="text-[#FF48B6] font-semibold">Rp{{ number_format($service->price) }}</p>
                    </div>
                </div>
                <button class="border-2 border-black rounded-full w-max px-8 py-2">Deposit</button>
                <input type="hidden" name="payment_type" value="down_payment">
            </div>
            <div class="flex items-center justify-between my-5">
                <p class="font-bold text-xl">Informasi Pelanggan</p>
                <svg fill="#FF48B6" height="1rem" width="1rem" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_224_" d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394 l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393 C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"></path> </g></svg>
            </div>
            <div class="flex items-center gap-5">
                <div class="w-1/2">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <p>Nama Lengkap</p>
                    <div class="mb-8 flex items-center gap-3 border rounded-full py-2 px-4 w-full">
                        <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.144"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="9" r="3" stroke="#FF48B6" stroke-width="1.2"></circle> <path d="M17.9691 20C17.81 17.1085 16.9247 15 11.9999 15C7.07521 15 6.18991 17.1085 6.03076 20" stroke="#FF48B6" stroke-width="1.2" stroke-linecap="round"></path> <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#FF48B6" stroke-width="1.2" stroke-linecap="round"></path> </g></svg>
                        <p class="font-bold">{{ $user->name }}</p>
                        <input type="hidden" name="name" value="{{ $user->name }}">
                    </div>
                    <p>Nomor Telpon</p>
                    <div class="flex items-center gap-3 border rounded-full py-2 px-4 w-full">
                        <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10.0376 5.31617L10.6866 6.4791C11.2723 7.52858 11.0372 8.90532 10.1147 9.8278C10.1147 9.8278 10.1147 9.8278 10.1147 9.8278C10.1146 9.82792 8.99588 10.9468 11.0245 12.9755C13.0525 15.0035 14.1714 13.8861 14.1722 13.8853C14.1722 13.8853 14.1722 13.8853 14.1722 13.8853C15.0947 12.9628 16.4714 12.7277 17.5209 13.3134L18.6838 13.9624C20.2686 14.8468 20.4557 17.0692 19.0628 18.4622C18.2258 19.2992 17.2004 19.9505 16.0669 19.9934C14.1588 20.0658 10.9183 19.5829 7.6677 16.3323C4.41713 13.0817 3.93421 9.84122 4.00655 7.93309C4.04952 6.7996 4.7008 5.77423 5.53781 4.93723C6.93076 3.54428 9.15317 3.73144 10.0376 5.31617Z" fill="#FF48B6"></path> </g></svg>
                        <p class="font-bold">{{ $user->phone }}</p>
                    </div>
                </div>
                <div class="w-1/2">
                    <p>Alamat Email</p>
                    <div class="mb-8 flex items-center gap-3 border rounded-full py-2 px-4 w-full">
                        <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 8L17.4392 9.97822C15.454 11.0811 14.4614 11.6326 13.4102 11.8488C12.4798 12.0401 11.5202 12.0401 10.5898 11.8488C9.53864 11.6326 8.54603 11.0811 6.5608 9.97822L3 8M6.2 19H17.8C18.9201 19 19.4802 19 19.908 18.782C20.2843 18.5903 20.5903 18.2843 20.782 17.908C21 17.4802 21 16.9201 21 15.8V8.2C21 7.0799 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V15.8C3 16.9201 3 17.4802 3.21799 17.908C3.40973 18.2843 3.71569 18.5903 4.09202 18.782C4.51984 19 5.07989 19 6.2 19Z" stroke="#FF48B6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        <p class="font-bold">{{ $user->email }}</p>
                    </div>
                    <p>Mulai Pada</p>
                    <div class="flex items-center gap-3 border rounded-full py-2 px-4 w-full">
                        <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.144"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="9" r="3" stroke="#FF48B6" stroke-width="1.2"></circle> <path d="M17.9691 20C17.81 17.1085 16.9247 15 11.9999 15C7.07521 15 6.18991 17.1085 6.03076 20" stroke="#FF48B6" stroke-width="1.2" stroke-linecap="round"></path> <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#FF48B6" stroke-width="1.2" stroke-linecap="round"></path> </g></svg>
                        <input type="date" class="border rounded-full py-2 px-4 w-1/2" name="transaction_date">
                    </div>
                </div>
            </div>
            <div class="my-5">
                <p>Waktu Pemesanan</p>
                <div class="flex items-center gap-3 border rounded-full py-2 px-4 w-full">
                    <svg width="2rem" height="2rem" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#FF48B6"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5 0H11L11.3803 3.0421C12.7003 3.94382 13.6417 5.35897 13.917 7H15V9H13.917C13.6417 10.641 12.7003 12.0562 11.3803 12.9579L11 16H5L4.61974 12.9579C3.03812 11.8775 2 10.06 2 8C2 5.94003 3.03812 4.12252 4.61974 3.0421L5 0ZM7 5V8.41421L9.29289 10.7071L10.7071 9.29289L9 7.58579V5H7Z" fill="#FF48B6"></path> </g></svg>
                    <div class="flex items-center font-bold gap-2">
                        <input type="time" class="border rounded-full py-2 px-4 w-1/2" name="start_time">
                        <p>-</p>
                        <input type="time" class="border rounded-full py-2 px-4 w-1/2" name="end_time">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white mx-36 rounded-xl p-10 my-10">
            <div class="flex items-center justify-between">
                <p class="font-bold text-xl">Tambahan Produk</p>
            </div>
            <hr>
            <div class="grid grid-cols-3 my-5">
                @foreach ($products as $product)
                    <button type="button" 
                        class="additional-product bg-white border hover:border-[#EB85FF] rounded-xl w-max p-8 shadow-lg active:border-[#EB85FF]" 
                        data-id="{{ $product->id }}" 
                        data-name="{{ $product->name }}" 
                        data-price="{{ $product->price }}">
                        
                        <img src="{{ '/storage/public/' . $product->image }}" alt="imgproduct" class="hover:w-56 transition w-56">
                        <p class="font-bold text-xl">{{ $product->name }}</p>
                        <p class="text-sm text-[#616369] my-3">{{ $product->product_category->name }}</p>
                        <p class="text-xl font-bold text-[#0D5CD7]">Rp{{ number_format($product->price) }}</p>
                    </button>
                @endforeach
            </div>
            <div class="flex items-center justify-between my-5">
                <p class="font-bold text-xl">Payment Details</p>
                <svg fill="#FF48B6" height="1rem" width="1rem" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="XMLID_224_" d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394 l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393 C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"></path> </g></svg>
            </div>
            <div class="flex justify-between gap-3 py-2 px-4 w-full">
                <div class="flex items-center gap-3">
                    <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M22 6V8.42C22 10 21 11 19.42 11H16V4.01C16 2.9 16.91 2 18.02 2C19.11 2.01 20.11 2.45 20.83 3.17C21.55 3.9 22 4.9 22 6Z" stroke="#FF48B6" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 7V21C2 21.83 2.93998 22.3 3.59998 21.8L5.31 20.52C5.71 20.22 6.27 20.26 6.63 20.62L8.28998 22.29C8.67998 22.68 9.32002 22.68 9.71002 22.29L11.39 20.61C11.74 20.26 12.3 20.22 12.69 20.52L14.4 21.8C15.06 22.29 16 21.82 16 21V4C16 2.9 16.9 2 18 2H7H6C3 2 2 3.79 2 6V7Z" stroke="#FF48B6" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.4" d="M6 9H12" stroke="#FF48B6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.4" d="M6.75 13H11.25" stroke="#FF48B6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    <p class="font-bold">Package Quantity</p>
                </div>
                <div>
                    {{-- service --}}
                    <div class="flex items-center gap-3">
                        <p class="font-bold text-xl">{{ $service->name }}</p>
                        <p class="italic">Rp{{ number_format($service->price) }}</p>
                    </div>
                    {{-- additional product --}}
                    <div class="flex items-center gap-3" id="selected-products">
                        {{-- <p class="font-bold text-xl">Nama Product</p>
                        <p class="italic">Rp.Harga Product</p> --}}
                        <p class="text-gray-500 italic">Tidak ada produk tambahan yang dipilih</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-3 py-2 px-4 w-full">
                <div class="flex items-center gap-3">
                    <svg width="2rem" height="2rem" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.0001 8.517C8.58589 8.517 8.2501 8.85279 8.2501 9.267C8.2501 9.68121 8.58589 10.017 9.0001 10.017V8.517ZM16.0001 10.017C16.4143 10.017 16.7501 9.68121 16.7501 9.267C16.7501 8.85279 16.4143 8.517 16.0001 8.517V10.017ZM9.8751 11.076C9.46089 11.076 9.1251 11.4118 9.1251 11.826C9.1251 12.2402 9.46089 12.576 9.8751 12.576V11.076ZM15.1251 12.576C15.5393 12.576 15.8751 12.2402 15.8751 11.826C15.8751 11.4118 15.5393 11.076 15.1251 11.076V12.576ZM9.1631 5V4.24998L9.15763 4.25002L9.1631 5ZM15.8381 5L15.8438 4.25H15.8381V5ZM19.5001 8.717L18.7501 8.71149V8.717H19.5001ZM19.5001 13.23H18.7501L18.7501 13.2355L19.5001 13.23ZM18.4384 15.8472L17.9042 15.3207L17.9042 15.3207L18.4384 15.8472ZM15.8371 16.947V17.697L15.8426 17.697L15.8371 16.947ZM9.1631 16.947V16.197C9.03469 16.197 8.90843 16.23 8.79641 16.2928L9.1631 16.947ZM5.5001 19H4.7501C4.7501 19.2662 4.89125 19.5125 5.12097 19.6471C5.35068 19.7817 5.63454 19.7844 5.86679 19.6542L5.5001 19ZM5.5001 8.717H6.25012L6.25008 8.71149L5.5001 8.717ZM6.56175 6.09984L6.02756 5.5734H6.02756L6.56175 6.09984ZM9.0001 10.017H16.0001V8.517H9.0001V10.017ZM9.8751 12.576H15.1251V11.076H9.8751V12.576ZM9.1631 5.75H15.8381V4.25H9.1631V5.75ZM15.8324 5.74998C17.4559 5.76225 18.762 7.08806 18.7501 8.71149L20.2501 8.72251C20.2681 6.2708 18.2955 4.26856 15.8438 4.25002L15.8324 5.74998ZM18.7501 8.717V13.23H20.2501V8.717H18.7501ZM18.7501 13.2355C18.7558 14.0153 18.4516 14.7653 17.9042 15.3207L18.9726 16.3736C19.7992 15.5348 20.2587 14.4021 20.2501 13.2245L18.7501 13.2355ZM17.9042 15.3207C17.3569 15.8761 16.6114 16.1913 15.8316 16.197L15.8426 17.697C17.0201 17.6884 18.1461 17.2124 18.9726 16.3736L17.9042 15.3207ZM15.8371 16.197H9.1631V17.697H15.8371V16.197ZM8.79641 16.2928L5.13341 18.3458L5.86679 19.6542L9.52979 17.6012L8.79641 16.2928ZM6.2501 19V8.717H4.7501V19H6.2501ZM6.25008 8.71149C6.24435 7.93175 6.54862 7.18167 7.09595 6.62627L6.02756 5.5734C5.20098 6.41216 4.74147 7.54494 4.75012 8.72251L6.25008 8.71149ZM7.09595 6.62627C7.64328 6.07088 8.38882 5.75566 9.16857 5.74998L9.15763 4.25002C7.98006 4.2586 6.85413 4.73464 6.02756 5.5734L7.09595 6.62627Z" fill="#FF48B6"></path> </g></svg>
                    <p class="font-bold">Consultation & Insurance</p>
                </div>
                <div>
                    <div class="flex items-center gap-3 mt-3">
                        <p class="italic">Rp.0</p>
                        <p class="font-bold text-xl">(Free)</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-3 py-2 px-4 w-full">
                <div class="flex items-center gap-3">
                    <svg width="2rem" height="2rem" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.0001 8.517C8.58589 8.517 8.2501 8.85279 8.2501 9.267C8.2501 9.68121 8.58589 10.017 9.0001 10.017V8.517ZM16.0001 10.017C16.4143 10.017 16.7501 9.68121 16.7501 9.267C16.7501 8.85279 16.4143 8.517 16.0001 8.517V10.017ZM9.8751 11.076C9.46089 11.076 9.1251 11.4118 9.1251 11.826C9.1251 12.2402 9.46089 12.576 9.8751 12.576V11.076ZM15.1251 12.576C15.5393 12.576 15.8751 12.2402 15.8751 11.826C15.8751 11.4118 15.5393 11.076 15.1251 11.076V12.576ZM9.1631 5V4.24998L9.15763 4.25002L9.1631 5ZM15.8381 5L15.8438 4.25H15.8381V5ZM19.5001 8.717L18.7501 8.71149V8.717H19.5001ZM19.5001 13.23H18.7501L18.7501 13.2355L19.5001 13.23ZM18.4384 15.8472L17.9042 15.3207L17.9042 15.3207L18.4384 15.8472ZM15.8371 16.947V17.697L15.8426 17.697L15.8371 16.947ZM9.1631 16.947V16.197C9.03469 16.197 8.90843 16.23 8.79641 16.2928L9.1631 16.947ZM5.5001 19H4.7501C4.7501 19.2662 4.89125 19.5125 5.12097 19.6471C5.35068 19.7817 5.63454 19.7844 5.86679 19.6542L5.5001 19ZM5.5001 8.717H6.25012L6.25008 8.71149L5.5001 8.717ZM6.56175 6.09984L6.02756 5.5734H6.02756L6.56175 6.09984ZM9.0001 10.017H16.0001V8.517H9.0001V10.017ZM9.8751 12.576H15.1251V11.076H9.8751V12.576ZM9.1631 5.75H15.8381V4.25H9.1631V5.75ZM15.8324 5.74998C17.4559 5.76225 18.762 7.08806 18.7501 8.71149L20.2501 8.72251C20.2681 6.2708 18.2955 4.26856 15.8438 4.25002L15.8324 5.74998ZM18.7501 8.717V13.23H20.2501V8.717H18.7501ZM18.7501 13.2355C18.7558 14.0153 18.4516 14.7653 17.9042 15.3207L18.9726 16.3736C19.7992 15.5348 20.2587 14.4021 20.2501 13.2245L18.7501 13.2355ZM17.9042 15.3207C17.3569 15.8761 16.6114 16.1913 15.8316 16.197L15.8426 17.697C17.0201 17.6884 18.1461 17.2124 18.9726 16.3736L17.9042 15.3207ZM15.8371 16.197H9.1631V17.697H15.8371V16.197ZM8.79641 16.2928L5.13341 18.3458L5.86679 19.6542L9.52979 17.6012L8.79641 16.2928ZM6.2501 19V8.717H4.7501V19H6.2501ZM6.25008 8.71149C6.24435 7.93175 6.54862 7.18167 7.09595 6.62627L6.02756 5.5734C5.20098 6.41216 4.74147 7.54494 4.75012 8.72251L6.25008 8.71149ZM7.09595 6.62627C7.64328 6.07088 8.38882 5.75566 9.16857 5.74998L9.15763 4.25002C7.98006 4.2586 6.85413 4.73464 6.02756 5.5734L7.09595 6.62627Z" fill="#FF48B6"></path> </g></svg>
                    <p class="font-bold">Grandtotal Amount</p>
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <p class="font-bold text-xl text-[#FF48B6]" id="total-price">Rp{{ number_format($service->price) }}</p>
                        <input type="hidden" name="total_price" value="{{ $service->price }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="flex justify-center items-center w-full text-center font-semibold bg-[#FF48B6] py-3 my-5 mx-20 rounded-full text-white">Bayar</button>
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

                // Cek apakah produk sudah dipilih
                let index = selectedProducts.findIndex(p => p.id === productId);
                if (index === -1) {
                    // Tambah produk ke daftar
                    selectedProducts.push({ id: productId, name: productName, price: productPrice });
                    totalPrice += productPrice;
                    $(this).addClass("border-[#EB85FF]"); // Efek visual untuk produk yang dipilih
                } else {
                    // Hapus produk dari daftar
                    selectedProducts.splice(index, 1);
                    totalPrice -= productPrice;
                    $(this).removeClass("border-[#EB85FF]"); // Hapus efek visual
                }

                updateSelectedProducts();
                updateTotalPrice();
            });

            function updateSelectedProducts() {
                let container = $("#selected-products");
                container.empty();

                if (selectedProducts.length === 0) {
                    container.append(
                        `<p class="text-gray-500 italic">Tidak ada produk tambahan yang dipilih</p>`
                    );
                } else {
                    selectedProducts.forEach(product => {
                        container.append(
                            `<div class="flex items-center gap-3">
                                <p class="font-bold text-xl">${product.name}</p>
                                <p class="italic">Rp${product.price.toLocaleString()}</p>
                                <input type="hidden" name="product_id[]" value="${product.id}">
                            </div>`
                        );
                    });
                }
            }

            function updateTotalPrice() {
                $("#total-price").text(`Rp${totalPrice.toLocaleString()}`);
                $("input[name='total_price']").val(totalPrice);
            }
        });
    </script>
</body>
</html>