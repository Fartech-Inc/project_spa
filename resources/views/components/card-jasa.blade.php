@props(['services'])

@foreach($services as $service)
    <a class="w-full border rounded-lg shadow-md p-4 hover:border-pink-500" href="{{ route('web.service', $service->id) }}">
        <img src="{{ $service->image }}" alt="{{ $service->name }}" class="rounded-md w-full h-48 object-cover mb-4">
        <h3 class="text-lg font-semibold mb-2">{{ $service->name }}</h3>
        <p class="text-pink-500 font-bold">Rp{{ number_format($service->price) }}</p>
    </a>
@endforeach