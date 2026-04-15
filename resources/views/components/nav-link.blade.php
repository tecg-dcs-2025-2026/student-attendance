@props(['route'])

@php
    $href = route($route);
    $active = request()->routeIs($route) || request()->routeIs($route . '.*');

    $baseClasses = 'px-4 py-2 rounded-md text-base font-medium transition-colors';

    $activeClasses = $active
                ? 'bg-blue-100 text-blue-900'
                : 'text-gray-700 hover:bg-gray-100';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses . ' ' . $activeClasses]) }}>
    {{ $slot }}
</a>
