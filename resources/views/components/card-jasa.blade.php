@props(['services'])

@foreach($services as $service)
    <a class="w-72 border rounded-lg shadow-md p-4 hover:border-pink-500" href="/details">
        <img src="{{ $service['image'] }}" alt="Image" class="rounded-md w-full h-48 object-cover mb-4">
        <h3 class="text-lg font-semibold mb-2">{{ $service['title'] }}</h3>
        {{-- <p class="text-gray-700 mb-4">{{ $service['description'] }}</p> --}}
        <p class="text-pink-500 font-bold">{{ $service['price'] }}</p>
    </a>
@endforeach