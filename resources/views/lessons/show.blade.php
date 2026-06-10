@props([
    'lesson' => null,
    '$students' => null,
])
<x-layout-app>
    <main class="container section-gap">
        <x-main-header :title="$lesson?->name ?? 'lesson'" />
        <x-students.grid :students="$students" />
    </main>
</x-layout-app>
