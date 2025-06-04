@props(['services'])

@foreach($services as $service)
    <a href="{{ route('web.service', $service->id) }}" class="border-2 border-[#eee] rounded-2xl p-4 hover:shadow-lg transition">
        <img
            src="{{ $service->image }}"
            alt="{{ $service->name }}"
            class="rounded-xl w-full aspect-video object-cover mb-3"
        />
        <h3 class="font-medium text-[#0A142F]">{{ $service->name }}</h3>
        <p class="text-pink-500 font-semibold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
    </a>
@endforeach
