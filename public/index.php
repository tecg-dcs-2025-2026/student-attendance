<?php

use Tecgdcs\Router;
use Illuminate\Database\Capsule\Manager as Capsule;

session_start();

require __DIR__ . '/../bootstrap/app.php';

require VENDOR_PATH . '/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();


$capsule = new Capsule;

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


new Router()->route();
