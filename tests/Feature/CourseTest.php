<?php

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('an authenticated user sees his courses after he logs in',
    function () {
        // Arrange
        $dominique = User::factory()->create();
        $daniel = User::factory()->create();

        $pw = Course::factory()->create([
            'name' => 'Projets Web',
            'code' => 'PW',
            'hours' => 240,
            'user_id' => $dominique->id,
        ]);
        $dcs = Course::factory()->create([
            'name' => 'Développement côté serveur',
            'code' => 'DCS',
            'hours' => 60,
            'user_id' => $dominique->id,
        ]);
        $mmi = Course::factory()->create([
            'name' => 'Multimédia Interactif',
            'code' => 'MMI',
            'hours' => 60,
            'user_id' => $daniel->id,
        ]);

        actingAs($dominique);

        // Act
        $response = get(route('courses.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertSeeInOrder([$dcs->name, $pw->name]);
        $response->assertDontSee($mmi->name);
    });

test('a course has many lessons',
    function () {

        $daniel = User::factory()->create();
        $mmi = Course::factory()
            ->has(Lesson::factory()->count(5))
            ->create([
                'name' => 'Multimédia Interactif',
                'code' => 'MMI',
                'hours' => 60,
                'user_id' => $daniel->id,
            ]);
        expect($mmi->lessons->count())->toBe(5);
    });

test('a course has many students enroled',
    function () {
        $daniel = User::factory()->create();
        $students_attending_mmi = Student::factory()->count(5)->create();
        $students_not_attending_mmi = Student::factory()->count(5)->create();
        $mmi = Course::factory()
            ->afterCreating(function (Course $course) use ($students_attending_mmi) {
                $course->students()->attach($students_attending_mmi->pluck('id'));
            })
            ->create([
                'name' => 'Multimédia Interactif',
                'code' => 'MMI',
                'hours' => 60,
                'user_id' => $daniel->id,
            ]);
        expect($mmi->students->count())->toBe(5);
        expect($mmi->students->pluck('id')->sort()->values())
            ->toEqual($students_attending_mmi->pluck('id')->sort()->values());
    });
