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
        if (!isset($_REQUEST['_token'], $_SESSION['token'])) {
            die('bad request');
        }

        if ($_REQUEST['_token'] !== $_SESSION['token']) {
            die('unauthorized');
        };
        // Stocker un étudiant en DB

        // Demander au navigateur de se rediriger vers la page de résultat souhaitée
        header('Location: /etudiants', response_code: 303);
    }

    public function show(): void
    {
        // Validation
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die('Bad Request');
        }

        // Sanitisation | Nettoyage | Préparation
        $id = (int)$_GET['id'];

        // Récupération des données
        $student = Student::find($id);

        // Gestion d'un cas d'exception
        if (!$student) {
            die('Student not found');
        }

        $title = 'La fiche de ' . $student->first_name;

        view('students.show',
            compact(
                'title',
                'student'
            )
        );


    }
}
