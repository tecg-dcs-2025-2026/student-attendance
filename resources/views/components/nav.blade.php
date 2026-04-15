<nav class="bg-white border-b border-gray-200" aria-labelledby="main-nav-id">
    <h2 class="sr-only" id="main-nav-id">navigation principale</h2>
    <ul class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center space-x-2 py-4">
        <li>
            <x-nav-link route="pages.home">Accueil</x-nav-link>
        </li>
        <li>
            <x-nav-link route="attendances.index">Présences</x-nav-link>
        </li>
        <li>
            <x-nav-link route="students.index">Étudiants</x-nav-link>
        </li>
    </ul>
</nav>
