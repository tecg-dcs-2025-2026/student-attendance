<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrolment;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dominique = User::factory()->create([
            'name' => 'Dominique',
            'email' => 'd@d.com',
            'password' => 'password',
        ]);
        $daniel = User::factory()->create([
            'name' => 'Daniel',
            'email' => 'd2@d.com',
            'password' => 'password',
        ]);

        $pw = Course::factory()
            ->has(Lesson::factory()->count(random_int(5, 10)))
            ->create([
                'name' => 'Projets Web',
                'code' => 'PW',
                'hours' => 240,
                'user_id' => $dominique->id,
            ]);
        $dcs = Course::factory()
            ->has(Lesson::factory()->count(random_int(5, 10)))
            ->create([
                'name' => 'Développement côté serveur',
                'code' => 'DCS',
                'hours' => 60,
                'user_id' => $dominique->id,
            ]);
        $mmi = Course::factory()
            ->has(Lesson::factory()->count(random_int(5, 10)))
            ->create([
                'name' => 'Multimédia Interactif',
                'code' => 'MMI',
                'hours' => 60,
                'user_id' => $daniel->id,
            ]);

        $students = require __DIR__.'/data/students.php';

        foreach ($students as $student) {
            $s = Student::create($student);
            foreach ([$pw, $dcs, $mmi] as $course) {
                Enrolment::create([
                    'course_id' => $course->id,
                    'student_id' => $s->id
                ]);
                foreach ($course->lessons as $lesson) {
                    $lesson
                        ->students()
                        ->attach($s->id);
                }
            }
        }
    }
}
