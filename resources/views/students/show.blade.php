<x-layout :title="$title">
    <x-header :title="$title">
        <nav aria-labelledby="actions-title">
            <h2 id="actions-title" class="sr-only">Actions relatives à {{ $student->first_name }}</h2>

            <ul class="flex flex-wrap gap-3 items-center">
                <li>
                    <a href="{{ route('students.edit', $student) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier <span class="sr-only">{{ $student->first_name }}</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('students.destroy', $student) }}" method="post" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer <span class="sr-only">{{ $student->first_name }}</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </x-header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 shadow-sm p-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Informations</h2>
            <dl class="space-y-6">
                <div class="flex items-center">
                    <dt class="text-sm font-medium text-gray-600 min-w-max pr-4">Prénom :</dt>
                    <dd class="text-gray-900">{{ $student->first_name }}</dd>
                </div>
                <div class="flex items-center">
                    <dt class="text-sm font-medium text-gray-600 min-w-max pr-4">Nom de famille :</dt>
                    <dd class="text-gray-900">{{ $student->last_name }}</dd>
                </div>
                <div class="flex items-center">
                    <dt class="text-sm font-medium text-gray-600 min-w-max pr-4">Matricule :</dt>
                    <dd class="text-gray-900">{{ $student->matricule }}</dd>
                </div>
                <div class="flex items-center">
                    <dt class="text-sm font-medium text-gray-600 min-w-max pr-4">Email :</dt>
                    <dd class="text-gray-900">
                        <a href="mailto:{{ $student->email }}"
                           class="text-blue-600 hover:text-blue-700 hover:underline">
                            {{ $student->email }}
                        </a>
                    </dd>
                </div>
                @if($student->birth_date)
                    <div class="flex items-center">
                        <dt class="text-sm font-medium text-gray-600 min-w-max pr-4">Date de naissance :</dt>
                        <dd class="text-gray-900">
                            <time
                                datetime="{{ $student->birth_date }}">{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</time>
                        </dd>
                    </div>
                @endif
            </dl>
        </div>

        <div class="lg:col-span-1 h-full">
            @if($student->profile_photo)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden h-full">
                    <h2 class="sr-only">Photo de profil</h2>
                    <img src="{{ $student->profile_photo }}"
                         alt="Portrait de {{ $student->first_name }} {{ $student->last_name }}"
                         class="w-full h-full object-cover">
                </div>
            @else
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden flex items-center justify-center h-full">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-600 text-sm font-medium">Aucune photo</p>
                        <p class="text-gray-500 text-xs mt-1">
                            <a href="{{ route('students.edit', $student) }}"
                               class="text-blue-600 hover:text-blue-700 hover:underline">Ajouter une photo</a>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <x-button-back route="{{ route('students.index') }}" label="Voir tous les étudiants"/>
</x-layout>
