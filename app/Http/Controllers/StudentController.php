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
        // Valider les données associées à la requête

        // Stocker un étudiant en DB
        $student = new Student();

        $student->first_name = $_POST['first_name'];
        $student->last_name = $_POST['last_name'];
        $student->email = $_POST['email'];
        $student->matricule = $_POST['matricule'];
        $student->birth_date = empty($_POST['birth_date']) ? null : $_POST['birth_date'];

        $student->save();

        // Demander au navigateur de se rediriger vers la page de résultat souhaitée
        header('Location: /etudiant?id=' . $student->id, response_code: 303);
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

        // Validation des données qui bloque si les données sont invalides

        $id = $this->check_id();

        $student = Student::find($id);

        $student->first_name = $_POST['first_name'];
        $student->last_name = $_POST['last_name'];
        $student->email = $_POST['email'];
        $student->matricule = $_POST['matricule'];
        $student->birth_date = empty($_POST['birth_date']) ? null : $_POST['birth_date'];

        $student->save();


        header('Location: /etudiant?id=' . $student->id, response_code: 303);

    }

    public function destroy(): void
    {
        $this->check_csrf();

        $id = $this->check_id();

        Student::destroy($id);

        header('Location: /etudiants', response_code: 303);
    }
}
