@props(['course'])
<a href="{{ route('courses.show', $course) }}" class="card card--link course-card">
    <div class="course-card__header">
        <div class="course-card__icon-wrap" aria-hidden="true">
            <svg class="course-card__icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z" />
                <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z" />
            </svg>
        </div>
        <span class="course-card__code">{{ $course->code }}</span>
    </div>
    <div>
        <h3 class="course-card__title">{{ $course->name }}</h3>
        <div class="course-card__meta">
            <span class="course-card__level">Licence 3</span>
            <span class="course-card__students">
                <x-svg.students />
                {{ $course->students_count }} {{ __('nouns.student(s)') }}
            </span>
        </div>
    </div>
</a>
