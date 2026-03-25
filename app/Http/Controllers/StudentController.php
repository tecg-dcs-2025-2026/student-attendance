<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController
{
    private function check_id(): ?int
    {
        // Validation
        if (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
            die('Bad Request');
        }

        // Sanitisation | Nettoyage | Préparation
        return (int)$_REQUEST['id'];
    }

    private function check_csrf(): void
    {

        if (!isset($_REQUEST['_token'], $_SESSION['token'])) {
            die('bad request');
        }

        if ($_REQUEST['_token'] !== $_SESSION['token']) {
            die('unauthorized');
        };
    }

    public function index(): void
    {
        $title = 'Tous les étudiants';
        $students = Student::all();

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
        $this->check_csrf();
        // Stocker un étudiant en DB

        // Demander au navigateur de se rediriger vers la page de résultat souhaitée
        header('Location: /etudiants', response_code: 303);
    }

    public function show(): void
    {
        $id = $this->check_id();

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

    public function edit(): void
    {
        $id = $this->check_id();

        // Récupération des données
        $student = Student::find($id);

        // Gestion d'un cas d'exception
        if (!$student) {
            die('Student not found');
        }

        $title = 'La fiche de ' . $student->first_name;

        view('students.edit',
            compact(
                'title',
                'student'
            )
        );
    }

    public function update(): void
    {
        $this->check_csrf();

        $id = $this->check_id();

        die('oui, update');
    }

    public function destroy(): void
    {
        $this->check_csrf();

        $id = $this->check_id();

        die('oui, destroy');
    }
}
