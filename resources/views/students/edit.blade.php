<x-layout :title="$title">
    <x-header
        :title="$title"
        description="Mettez à jour les informations de l’étudiant."
    >
        <section>
            <h2 class="sr-only">Actions relatives à {{ $student->first_name }}</h2>
            <ul>
                <li>
                    <form action="{{ route('students.destroy', $student) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer <span class="sr-only">{{ $student->first_name }}</span>
                        </button>
                    </form>
                </li>
            </ul>
        </section>
    </x-header>

    <form action="{{ route('students.update', $student) }}" method="post" enctype="multipart/form-data"
          class=" bg-white rounded-lg border border-gray-200 shadow-sm p-8 space-y-6">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="last_name" label="Nom de famille" type="text" :value="$student->last_name" placeholder="Ex : Johansson" :error="$errors->has('last_name')" required/>
            <x-input-field name="first_name" label="Prénom" type="text" :value="$student->first_name" placeholder="Ex : Jean" :error="$errors->has('first_name')" required/>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="email" label="Email" type="email" :value="$student->email" placeholder="Ex : jean@student.hepl.be" :error="$errors->has('email')" required/>
            <x-input-field name="matricule" label="Matricule" type="text" :value="$student->matricule" placeholder="Ex : tecg1234" :error="$errors->has('matricule')" required/>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="birth_date" label="Date de naissance" type="date" :value="$student->birth_date" placeholder="Ex : 12/30/2000" :error="$errors->has('birth_date')" required/>
            <x-input-field name="profile_photo" label="Photo de profil" type="file" :value="$student->profile_photo" :error="$errors->has('profile_photo')" required/>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit"
                    class="flex-1 md:flex-none px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                Enregistrer les modifications
            </button>
            <a href="{{ route('students.show', $student) }}"
               class="flex-1 md:flex-none px-8 py-3 bg-gray-200 text-gray-900 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                Annuler
            </a>
        </div>
    </form>

    <x-button-back route="{{ route('students.index') }}" label="Voir tous les étudiants"/>
</x-layout>
