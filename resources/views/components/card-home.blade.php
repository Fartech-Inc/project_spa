@props(['services'])

<div class="flex gap-4 mx-14 overflow-x-auto pb-5">
    @foreach ($services as $service)
        <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center w-56" style="background-image: url('{{ asset($service['image']) }}')">
            <p class="bg-white rounded-full py-3 px-3 mt-36 font-bold text-[#10062B] text-center">{{ $service['name'] }}</p>
        </div>
    @endforeach
</div>