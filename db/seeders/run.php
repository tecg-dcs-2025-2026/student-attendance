<?php

use Illuminate\Database\Capsule\Manager as Capsule;

use App\Models\Student;

include __DIR__ . '/../connexion.php';

/**
 * Création des étudiants
 */

$students = require __DIR__ . '/data/students.php';

Capsule::table('students')->truncate();
foreach ($students as $student) {
    Student::create($student);
}