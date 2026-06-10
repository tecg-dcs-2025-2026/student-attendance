@props(['lesson', 'isNext' => false])
<a href="{{ route('lessons.show', $lesson) }}" class="card card--link card--highlighted lesson-card">
    @if ($isNext)
        <span class="lesson-card__badge">Prochaine séance</span>
    @endif
    <h3 class="lesson-card__title">{{ $lesson->name }}</h3>
    <div class="lesson-card__details">
        <span class="lesson-card__detail">
            <x-svg.calendar />
            {{ $lesson->starts_at->isoFormat('dddd D MMMM') }}
        </span>
        <span class="lesson-card__detail">
            <x-svg.clock />
            {{ $lesson->starts_at->isoFormat('HH-mm') }} - {{ $lesson->ends_at->isoFormat('HH-mm') }}
        </span>
        <span class="lesson-card__detail">
            <x-svg.room />
            {{-- {{ $lesson->room }} --}}
            Salle A301
        </span>
    </div>
</a>
