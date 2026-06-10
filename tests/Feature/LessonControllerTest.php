<?php


use App\Models\Course;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\User;

use function Pest\Laravel\actingAs;

it(
    'has a lessons.show route',
    function () {
        $user = User::factory()
            ->has(
                Course::factory()
                    ->hasLessons()
            )->create();
        $lesson = $user->courses()->first()->lessons->first();
        $response = actingAs($user)->get(route('lessons.show', $lesson));

        $response->assertStatus(200);
    }
);

it(
    'redirects to home a user who attempts to access a lesson from another user',
    function () {
        $user = User::factory()
            ->has(
                Course::factory()
                    ->hasLessons()
            )->create();
        $lesson = $user->courses()->first()->lessons->first();
        $user1 = User::factory()->create();

        $response = actingAs($user1)->get(route('lessons.show', $lesson));

        $response->assertRedirect(route('home'));
    }
);

it(
    'passes the lesson to its the view',
    function () {
        $user = User::factory()
            ->has(
                Course::factory()
                    ->hasLessons()
            )->create();
        $lesson = $user->courses()->first()->lessons->first();

        $response = actingAs($user)->get(route('lessons.show', $lesson));

        $response->assertViewHas('lesson', $lesson);
    }
);

it(
    'passes the students of a lesson to the view in order to display them on the lessons.show view',
    function () {
        $user = User::factory()
            ->has(
                Course::factory()
                    ->has(
                        Lesson::factory()
                            ->hasAttached(Student::factory())
                    )
            )->create();
        $lesson = $user->courses()->first()->lessons->first();

        $response = actingAs($user)->get(route('lessons.show', $lesson));

        $response->assertViewHas('students');
        expect($response['students']->count())->toBe(1);
    }
);

it(
    'displays the title of the lesson in the lessons.show view',
    function(){
        $user = User::factory()
            ->has(
                Course::factory()
                    ->has(
                        Lesson::factory()
                            ->hasAttached(Student::factory())
                    )
            )->create();
        $lesson = $user->courses()->first()->lessons->first();

        $response = actingAs($user)->get(route('lessons.show', $lesson));
        $response->assertSee($lesson->name);
    }
);

it(
    'uses a grid blade component in order to display the list of students',
    function(){
        $contents = file_get_contents(resource_path('views/lessons/show.blade.php'));
        expect($contents)->toContain('<x-students.grid');
    }
);

it(
    'lists the students attending the lesson when visiting the lessons.show route',
    function(){
        $user = User::factory()
            ->has(
                Course::factory()
                    ->has(
                        Lesson::factory()
                            ->hasAttached(Student::factory(10))
                    )
            )->create();
        $lesson = $user->courses()->first()->lessons->first();

        $response = actingAs($user)->get(route('lessons.show', $lesson));
        $response->assertSeeInOrder($lesson->students->sortBy('last_name')->pluck('last_name')->toArray());
    }
);
