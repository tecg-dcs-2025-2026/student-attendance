<?php
require __DIR__ . '/../bootstrap/app.php';

require VENDOR_PATH . '/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

include DB_PATH . '/queries.php';

$title = '';


switch ($_SERVER['REQUEST_URI']) {
    case '':
    case '/':
        $title = 'Page d’accueil';
        include VIEWS_PATH . '/home.php';
        break;
    case '/presences':
        $title = 'Prendre les présences';
        include VIEWS_PATH . '/attendances/index.php';
        break;
    case '/etudiants':
        $title = 'Tous les étudiants';
        include VIEWS_PATH . '/students/index.php';
        break;
    default:
        $title = '404';
        include VIEWS_PATH . '/404.php';
}
