<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . "/../vendor/autoload.php";

use Database\Database;

use Buki\Router\Router;

/**
 * IMPORT DES CONTROLLERS
 */
use Controller\TrajetController;

$trajetController = new TrajetController($pdo);


/**
 * CONFIGURATION DU ROUTEUR
 */
$config = require __DIR__ . "/../config/config.php";

$db = new Database($config);
$pdo = $db->getConnection();

// Configuration du routeur
session_start();

$router = new Router([
    'base_folder' => '/Devoir_Touche_Pas_Au_Klaxon/PHP/public'
]);

/**
 * ROUTES
 */
$router->get('/', function() use ($trajetController) {
    $trajetController->index();
});

$router->get('/trajets/(\d+)', function($id) use ($trajetController) {
    $trajetController->show((int)$id);
});


/**
 * DISPATCH
 */
$router->run();
