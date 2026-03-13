<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController
{
    public function index(): void
    {
        $title = 'Tous les étudiants';
        $students = Student::getAllStudents();

        view(
            'students.index',
            compact('title', 'students')
        );
    }

    public function create(): void
    {
        $title = 'Ajouter un étudiant';

        view(
            'students.create',
            compact('title')
        );
    }

    public function store(): void
    {
        // Stocker un étudiant en DB
        // Demander au navigateur de se rediriger vers la page de résultat souhaitée
        die('enregistré');
    }
}
