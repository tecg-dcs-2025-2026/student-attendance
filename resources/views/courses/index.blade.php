<x-layout-app title="Mes cours">
    <main class="container section-gap">
        <x-main-header title="Mes cours" />
        @if($user->courses->isNotEmpty())
            <x-courses.grid :courses="$user->courses" />
        @else
            <p>Vous n’êtes titulaire d’aucun cours.</p>
        @endif
    </main>
</x-layout-app>
