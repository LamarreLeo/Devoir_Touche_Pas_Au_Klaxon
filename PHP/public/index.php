<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use Database\Database;

use Buki\Router\Router;

use Model\User;
use Model\Agence;
use Model\Trajet;

// Configuration de la base de données
$config = require __DIR__ . "/../config/config.php";

$db = new Database($config);
$pdo = $db->getConnection();

// Configuration du routeur
session_start();

$router = new Router([
    'base_folder' => '/Devoir_Touche_Pas_Au_Klaxon/PHP/public'
]);

// ROUTE DE TEST PROVISOIR
$router->get('/', function() {
    echo "Le routeur fonctionne correctement !";
});

$router->get('/test-db', function() use ($pdo) {
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll();
    echo "<pre>";
    print_r($tables);
    echo "</pre>";
});

$router->get('/test-user', function() use ($pdo) {
    $userModel = new User($pdo);
    $user = $userModel->findByEmail('admin@admin.com');

    echo "<pre>";
    print_r($user);
    echo "</pre>";
});

$router->get('/test-agences', function() use ($pdo) {
    $agenceModel = new Agence($pdo);
    $agences = $agenceModel->findAll();

    echo "<pre>";
    print_r($agences);
    echo "</pre>";
});

$router->get('/test-trajets', function() use ($pdo) {
    $trajetModel = new Trajet($pdo);
    $trajet = $trajetModel->findAll();

    echo "<pre>";
    print_r($trajet);
    echo "</pre>";
});

// DISPATCH
$router->run();
