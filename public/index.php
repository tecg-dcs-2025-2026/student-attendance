<?php
require __DIR__ . '/../bootstrap/app.php';

require VENDOR_PATH . '/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

include DB_PATH . '/queries.php';


switch ($_SERVER['REQUEST_URI']) {
    case '':
    case '/':
        require CONTROLLERS_PATH . '/PageController.php';
        home();
        break;
    case '/presences':
        require CONTROLLERS_PATH . '/AttendanceController.php';
        index();
        break;
    case '/etudiants':
        require CONTROLLERS_PATH . '/StudentController.php';
        index();
        break;
    default:
        $title = '404';
        include VIEWS_PATH . '/404.php';
}
