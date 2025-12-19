<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Database\Database;
use Buki\Router\Router;
use Controller\TrajetController;
use Controller\UserController;

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
$userController = new UserController($pdo);

/**
 * ROUTER
 */
$router = new Router([
    'base_folder' => '/Devoir_Touche_Pas_Au_Klaxon/PHP/public',
    'paths' => [
        'controllers' => __DIR__ . '/../src/Controllers',
    ],
    'namespaces' => [
        'controllers' => 'Controller',
    ],
    'main_method' => 'main'
]);

/**
 * ROUTES
 */

// Page d'accueil
$router->get('/', function () use ($trajetController) {
    $trajetController->index();
});

// Authentification
$router->get('/login', function () use ($userController) {
    $userController->showLoginForm();
});

$router->post('/login', function () use ($userController) {
    $userController->login();
});

$router->get('/logout', function () use ($userController) {
    $userController->logout();
});

$router->post('/trajets/delete', function () use ($trajetController) {
    $id = $_POST['id'] ?? 0;
    $trajetController->delete((int) $id);
});

// Page création de trajet
$router->any('/trajets/create', function () use ($trajetController) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $trajetController->create();
    } else {
        $trajetController->create();
    }
});

// Page de modification de trajet
$router->any('/trajets/edit', function () use ($trajetController) {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $trajetController->edit((int) $id);
    } else {
        echo "ID manquant";
        exit;
    }
});

/**
 * DISPATCH
 */
$router->run();
