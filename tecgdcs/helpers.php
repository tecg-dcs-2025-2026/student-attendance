<?php

use JetBrains\PhpStorm\NoReturn;

if (!function_exists('dd')) {
    #[NoReturn]
    function dd(...$vars): void
    {
        foreach ($vars as $var) {
            var_dump($var);
            echo PHP_EOL;
        }
        die();
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null): mixed
    {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('db_connection')) {
    function db_connection(): void
    {
        $capsule = new \Illuminate\Database\Capsule\Manager();

        $capsule->addConnection([
            'driver' => env('DB_CONNECTION'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => env('DB_CHARSET'),
            'collation' => env('DB_COLLATION'),
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();

    }
}

if (!function_exists('view')) {
    function view(string $name, array $data = []): void
    {
        $name = str_replace('.', '/', $name);
        $view = VIEWS_PATH . '/' . $name . '.php';
        if (file_exists($view)) {
            extract($data);
            include $view;
        } else {
            die('La vue n’existe pas');
        }

    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(int $length = 32): string
    {
        return $_SESSION['token'] ?? bin2hex(random_bytes($length));
    }
}