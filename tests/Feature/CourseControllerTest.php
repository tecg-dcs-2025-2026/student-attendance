<?php

use App\Models\Course;
use App\Models\User;

it(
    'has an index route for courses',
    function () {
        $user = User::factory()->create();

        // Redirect if not authenticated
        $response = $this->get(route('courses.index'));

        $response->assertStatus(302);

        // Ok if authenticated
        \Pest\Laravel\actingAs($user);

        $response = $this->get(route('courses.index'));

        $response->assertStatus(200);
    }
);

it(
    'passes a title to the index view',
    function () {
        $user = User::factory()->create();
        \Pest\Laravel\actingAs($user);

        $response = $this->get(route('courses.index'));

        $response->assertViewHas('title');
    }
);

it(
    'has a show route for courses',
    function () {
        $user = User::factory()->create();
        $course = Course::factory()
            ->for($user)
            ->create();

        // Redirect if not authenticated
        $response = $this->get(route('courses.show', $course));

        $response->assertStatus(302);

        // Ok if authenticated
        \Pest\Laravel\actingAs($user);

        $response = $this->get(route('courses.show', $course));

        $response->assertStatus(200);
    }
);

it(
    'passes the required course name as a title to the courses.show view',
    function () {
        $user = User::factory()
            ->hasCourses()
            ->create();
        \Pest\Laravel\actingAs($user);
        $course = $user->courses()->first();

        $response = $this->get(route('courses.show', $course));

        $response->assertViewHas('title', $course->name);
    }
);

it(
    'indexes a user his courses',
    function () {
        $user1 = User::factory()
            ->hasCourses()
            ->create();
        $user2 = User::factory()
            ->hasCourses()
            ->create();
        \Pest\Laravel\actingAs($user1);

        $response = $this->get(route('courses.index'));

        $response->assertSee($user1->courses->first()->name);
    }
);

it(
    'tells the user that there are no courses if he has none',
    function () {
        $user = User::factory()->create();
        \Pest\Laravel\actingAs($user);
        $response = $this->get(route('courses.index'));
        $response->assertSee(__('aucun cours'));
    }
);

it(
    'does not index a user the courses of another user',
    function () {
        $user1 = User::factory()
            ->hasCourses()
            ->create();
        $user2 = User::factory()
            ->hasCourses()
            ->create();
        \Pest\Laravel\actingAs($user1);

        $response = $this->get(route('courses.index'));

        $response->assertDontSee($user2->courses->first()->name);
    }
);

it(
    'indexes the courses in the ascending order of course names',
    function () {
        $user1 = User::factory()
            ->hasCourses(10)
            ->create();
        \Pest\Laravel\actingAs($user1);

        $response = $this->get(route('courses.index'));

        $response->assertSeeInOrder($user1->courses->sortBy('name')->pluck('name')->toArray());
    }
);

it(
    'indexes the courses with the count of enrolled students',
    function () {
        $user1 = User::factory()
            ->has(
                Course::factory()
                    ->hasStudents()
            )
            ->create();
        \Pest\Laravel\actingAs($user1);
        $student_count = $user1->courses()->first()->students()->count();

        $response = $this->get(route('courses.index'));

        $response->assertSee($student_count.' '.__('nouns.student(s)'));
    }
);

it(
    'redirects to home a user attempting to show a course that belongs to another user',
    function () {
        $user1 = User::factory()
            ->hasCourses()
            ->create();
        $user2 = User::factory()
            ->hasCourses()
            ->create();
        \Pest\Laravel\actingAs($user1);

        $response = $this->get(route('courses.show', $user2->courses()->first()));

        $response->assertRedirect(route('home'));
    }
);

it(
    'eager loads the lessons of course in order to display them on the courses.show view',
    function () {
        $user1 = User::factory()
            ->has(
                Course::factory()
                    ->hasLessons()
            )
            ->create();
        \Pest\Laravel\actingAs($user1);

        $response = $this->get(route('courses.show', $user1->courses()->first()));

        expect($response['course']->relationLoaded('lessons'))->toBeTrue();
    }
);

it(
    'displays the lessons of a course in their chronological order',
    function () {
        $user1 = User::factory()
            ->has(
                Course::factory()
                    ->hasLessons(5)
            )
            ->create();
        \Pest\Laravel\actingAs($user1);
        $course = $user1->courses()->first();

        $response = $this->get(route('courses.show', $course));

        $response->assertSeeInOrder($course->lessons()->get()->sortBy('starts_at')->pluck('name')->toArray());
    }
);

it(
    'tells the user that there are no lessons if he has none',
    function () {
        $user1 = User::factory()
            ->has(
                Course::factory()
            )
            ->create();
        \Pest\Laravel\actingAs($user1);
        $response = $this->get(route('courses.show', $user1->courses()->first()));
        $response->assertSee('Aucune leçon');
    }
);
