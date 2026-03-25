<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tecgdcs\Response;

class StudentController
{
    private function check_id(): ?int
    {
        // Validation
        if (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
            Response::abort(Response::BAD_REQUEST);
        }

        // Sanitisation | Nettoyage | Préparation
        return (int)$_REQUEST['id'];
    }

    private function check_csrf(): void
    {

        if (!isset($_REQUEST['_token'], $_SESSION['token'])) {
            Response::abort(Response::BAD_REQUEST);
        }

        if ($_REQUEST['_token'] !== $_SESSION['token']) {
            Response::abort(Response::UNAUTHORIZED);
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
        Response::redirect('Location: /etudiant?id=' . $student->id);
    }

    public function show(): void
    {
        $id = $this->check_id();

        try {
            $student = Student::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Response::abort();
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

        try {
            $student = Student::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Response::abort();
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


        Response::redirect('Location: /etudiant?id=' . $student->id);

    }

    public function destroy(): void
    {
        $this->check_csrf();

        $id = $this->check_id();

        Student::destroy($id);

        Response::redirect('Location: /etudiants');
    }
}
