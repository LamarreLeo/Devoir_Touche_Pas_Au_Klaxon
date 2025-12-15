<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Database\Database;
use Buki\Router\Router;
use Controller\TrajetController;

/**
 * CONFIGURATION
 */
session_start();

$config = require __DIR__ . '/../config/config.php';

/**
 * CONNEXION DB
 */
$db = new Database($config);
$pdo = $db->getConnection();

/**
 * CONTROLLERS
 */
$trajetController = new TrajetController($pdo);

/**
 * ROUTER
 */
$router = new Router([
    'base_folder' => '/Devoir_Touche_Pas_Au_Klaxon/PHP/public'
]);

/**
 * ROUTES
 */
$router->get('/', function () use ($trajetController) {
    $trajetController->index();
});

$router->get('/trajets/(\d+)', function ($id) use ($trajetController) {
    $trajetController->show((int) $id);
});

/**
 * DISPATCH
 */
$router->run();
