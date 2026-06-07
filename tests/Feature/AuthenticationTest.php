<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it(
    'has a route to access a login form',
    function () {
        // Act
        $response = get(route('login'));

        // Assert
        $response->assertStatus(200);
        $response->assertSee(
            'action="'.route('login.store').'"',
            false
        );
        $response->assertSee('Connexion à votre espace privé');
        $response->assertSeeInOrder([
            'name="_token"',
            'type="email"',
            'type="password"',
            'type="submit"',
        ], false);
    }
);

it(
    'redirects a successfully authenticated user to the predefined home page',
    function () {
        // Arrange
        $userData = [
            'email' => 'd@d.com',
            'password' => 'password',
            'name' => 'Dominique',
        ];
        User::create($userData);

        // Act
        $response = post(
            route('login.store'),
            $userData,
        );

        // Assert
        assertAuthenticated(config('fortify.guard'));
        $response->assertRedirect(config('fortify.home'));
    }
);

it(
    'redirects a guest to the login route when he tries to access an auth only route',
    function () {
        $authRoutes =
            collect(Route::getRoutes())
                ->filter(
                    fn ($route) => in_array('auth', $route->gatherMiddleware())
                );

        expect($authRoutes->count())
            ->toBeGreaterThan(0);

        foreach ($authRoutes as $route) {
            $methods = $route->methods();
            $method = strtolower($methods[0]);
            $response = $this->$method($route->uri);
            $response->assertRedirect(route('login'));
        }
    }
);

it(
    'displays a logout button to an authenticated user',
    function () {
        // Arrange
        actingAs(User::factory()->create());

        // Act
        $response = get(route('courses.index'));

        // Assert
        $response->assertSeeInOrder([
            'action="'.route('logout').'"',
            'name="_token"',
            'type="submit"',
        ], false);
        $response->assertSee(ucfirst(__('verbs.logout')));
    }
);

it(
    'does not display the logout button to a guest',
    function () {
        // Act
        $response = get(route('home'));

        // Assert
        $response->assertDontSee(ucfirst(__('verbs.logout')));
    }
);

it(
    'displays a login link to a guest user on the home page',
    function () {
        $response = get(route('home'));
        $response->assertSee(
            'href="'.route('login').'"',
            false
        );
        $response->assertSee(ucfirst(__('verbs.login')));

        actingAs(User::factory()->create());
        $response = get(route('home'));
        $response->assertDontSee(
            'href="'.route('login').'"',
            false
        );
        $response->assertDontSee(ucfirst(__('verbs.login')));
    }
);
