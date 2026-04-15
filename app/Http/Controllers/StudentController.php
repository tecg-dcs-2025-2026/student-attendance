<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    public function index(): View|Factory
    {
        $title = 'Tous les étudiants';
        $students = Student::all();

        return view(
            'students.index',
            compact('title', 'students')
        );
    }

    public function create(): View|Factory
    {
        $title = 'Ajouter un étudiant';

        return view(
            'students.create',
            compact('title')
        );
    }

    public function store(StudentRequest $request): RedirectResponse
    {
        $student = Student::create($request->validated());

        return redirect()->route('students.show', $student);
    }

    public function show(Student $student): View|Factory
    {
        $title = 'La fiche de '.$student->first_name;

        return view('students.show',
            compact(
                'title',
                'student'
            )
        );

    }

    public function edit(Student $student): View|Factory
    {
        $title = 'Modifier la fiche de '.$student->first_name;

        return view('students.edit',
            compact(
                'title',
                'student'
            )
        );
    }

    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect()->route('students.show', $student);

    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
