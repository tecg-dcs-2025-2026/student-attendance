<x-layout :title="$title">
    <x-header
        :title="$title"
        description="Remplissez le formulaire ci-dessous pour ajouter un nouvel étudiant."
    />

    <form action="{{ route('students.store') }}"
          method="post"
          enctype="multipart/form-data"
          class=" bg-white rounded-lg border border-gray-200 shadow-sm p-8 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="last_name" label="Nom de famille" type="text" placeholder="Ex : Johansson" :error="$errors->has('last_name')" required/>
            <x-input-field name="first_name" label="Prénom" type="text" placeholder="Ex : Jean" :error="$errors->has('first_name')" required/>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="email" label="Email" type="email" placeholder="Ex : jean@student.hepl.be" :error="$errors->has('email')" required/>
            <x-input-field name="matricule" label="Matricule" type="text" placeholder="Ex : tecg1234" :error="$errors->has('matricule')" required/>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="birth_date" label="Date de naissance" type="date" placeholder="Ex : 12/30/2000" :error="$errors->has('birth_date')"/>
            <x-input-field name="profile_photo" label="Photo de profil" type="file" :error="$errors->has('profile_photo')"/>
        </div>

        <div class="flex gap-4 pt-4">
            <button type="submit"
                    class="flex-1 md:flex-none px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                Enregistrer l’étudiant
            </button>
            <a href="{{ route('students.index') }}"
               class="flex-1 md:flex-none px-8 py-3 bg-gray-200 text-gray-900 font-medium rounded-lg hover:bg-gray-300 transition-colors">
                Annuler
            </a>
        </div>
    </form>

    <x-button-back route="{{ route('students.index') }}" label="Voir tous les étudiants"/>
</x-layout>
