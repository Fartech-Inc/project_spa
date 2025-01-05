<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <x-navbar></x-navbar>
    <div class="flex items-center mx-14 gap-5 mt-20">
        <div class="bg-white rounded-lg border p-5">
            <img src="img/massage.png" alt="profile">
            <button class="bg-[#D70DBFCC] text-white px-10 py-3 rounded">Pilih Foto</button>
        </div>
        <div class="font-semibold">
            <p>Biodata Diri</p>
            <p>Nama : Yoga Pratama</p>
            <p>Tanggal Lahir : 1 Mei 2001</p>
            <p>Gender : Laki-laki</p>
            <p class="mt-10">Email : Yoga.Pratama@gmail.com</p>
            <p>Nomor Handphone</p>
        </div>
    </div>
</body>
</html>