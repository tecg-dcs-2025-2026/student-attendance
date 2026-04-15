<x-layout :title="$title">
    <x-header :title="$title"/>

    @if($students)
        <form action="" method="POST">
            <ol class="student-list">
                @foreach($students as $student)
                    <li>
                        <input id="student-{{ $student->id }}"
                               type="checkbox"
                               name="students[]"
                               value="{{ $student->id }}">
                        <label for="student-{{ $student->id }}">
                            {{$student->first_name}} &nbsp;{{ $student->last_name }}
                        </label>
                    </li>
                @endforeach
            </ol>
            <button type="submit">Enregistrer les présences</button>
        </form>
    @endif
    <button class="randomStudentBtn hidden">Choisir un·e étudiant·e</button>
    <p class="currentStudent hidden"></p>
</x-layout>
