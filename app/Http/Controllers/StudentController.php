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

    public function show(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $student = Student::getStudentById($id);

        if ($student === null) {
            http_response_code(404);
            view('404', ['title' => 'Étudiant introuvable']);
            return;
        }

        $title = htmlspecialchars($student['first_name']) . ' ' . htmlspecialchars($student['last_name']);

        view(
            'students.show',
            compact('title', 'student')
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
        die('enregistré');
    }
}
