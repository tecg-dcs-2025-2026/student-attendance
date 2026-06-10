<?php


use App\Models\Course;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\User;

test(
    'a lesson has many students attending',
    function () {
        $user = User::factory()
            ->has(
                Course::factory()
                    ->has(
                        Lesson::factory()
                            ->hasAttached(Student::factory(3))
                    )
            )
            ->create();

        expect(
            $user->courses()->first()->lessons()->first()->students
        )->toHaveCount(3);
    }
);
