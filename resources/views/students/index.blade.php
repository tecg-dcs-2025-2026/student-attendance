<x-layout :title="$title">
    <x-header :title="$title">
        <a href="{{ route('students.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un étudiant
        </a>
    </x-header>

    @if(count($students) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($students as $student)
                <a href="{{ route('students.show', $student) }}" class="group block p-6 bg-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all hover:bg-blue-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                            {{ $student->first_name }}&nbsp;{{ $student->last_name }}
                        </h2>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Matricule: <span class="font-semibold">{{ $student->matricule }}</span></p>
                </a>
            @endforeach
        </div>
    @else
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-8 text-center">
            <svg class="w-12 h-12 text-amber-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-amber-900 font-medium text-lg">Mais où sont-ils&nbsp;?</p>
            <p class="text-amber-700 text-sm mt-2">Aucun étudiant trouvé. Commencez par en ajouter un.</p>
            <a href="{{ route('students.create') }}" class="inline-flex items-center mt-6 px-4 py-2 bg-amber-600 text-white font-medium rounded-lg hover:bg-amber-700 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter un étudiant
            </a>
        </div>
    @endif
</x-layout>
