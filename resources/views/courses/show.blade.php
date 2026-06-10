@props(['course' => null])
<x-layout-app>
    <main class="container section-gap">
        <x-main-header :title="$course?->name ?? 'cours 1'" />
        @if($course->lessons->isNotEmpty())
            <x-lessons.list :lessons="$course->lessons" />
        @else
            <p>Aucune leçon prévue.</p>
        @endif
    </main>
</x-layout-app>
