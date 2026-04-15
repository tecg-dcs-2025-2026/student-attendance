@props([
    'title',
    'description' => null,
])

<header class="flex justify-between">
    @if($description)
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $title }}</h1>
            <p class="text-gray-600 mt-2">{{ $description }}</p>
        </div>
    @else
        <h1 class="text-3xl font-bold text-gray-900">{{ $title }}</h1>
    @endif

    {{ $slot }}
</header>
