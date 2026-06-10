<div>
    <ol>
        @foreach($students as $student)
            <li>{{ $student->last_name }}</li>
        @endforeach
    </ol>
</div>
