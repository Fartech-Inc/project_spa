<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
    <style>
        .card_failed {
            padding: 20px;
        }
    </style>
</head>
<body>
    <x-navbar></x-navbar>

    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 items-center justify-center gap-8 min-h-screen py-44 lg:py-0">
        <div class="bg-white rounded-4xl px-8 py-20 max-w-md w-full shadow">
          <p class="text-2xl text-center font-bold mb-4">Booking Failed!</p>
          <p class="mb-4 text-center">Pemesanan mu gagal, coba ulangi kembali.</p>
          <div class="flex flex-col">
            <a href="/mybooking-details" class="my-2 text-center font-semibold bg-[#FF48B6] py-3 rounded-full text-white">Back</a>
          </div>
        </div>
        <img src="img/booking-failed.png" alt="booking failed" class="max-w-lg w-full" />
      </div>
    
      <script>
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        hamburgerBtn.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
        });
      </script>

    <x-footer></x-footer>
</body>
</html>