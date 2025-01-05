@props(['services'])

<div class="bg-pink-100 p-10">
    @foreach($services as $service)
        <div class="bg-white shadow-lg rounded-lg p-5 mb-5 flex items-center justify-between border-l-4
        @if($loop->index == 1) border-red-500 bg-red-100 @elseif($loop->index == 2) border-green-500 bg-green-100 @else border-gray-300 @endif">
            <div>
                <p class="text-xl font-bold">{{ $service['name'] }}</p>
                <p class="text-gray-500">{{ $service['kode-book'] }}</p>
                <p class="text-purple-600 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 12h18m-9 9h3m-3-3h3m-3-3h3m-3-3h3m-3-3h3"></path>
                    </svg>
                    {{ $service['schedule'] }}
                </p>
            </div>
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg @if($loop->index == 1) bg-red-700 @elseif($loop->index == 2) bg-green-500 @else bg-red-500 @endif">
                @if($loop->index == 1)
                    Dibatalkan
                @elseif($loop->index == 2)
                    Selesai
                @else
                    Batalkan
                @endif
            </button>
        </div>
    @endforeach
</div>