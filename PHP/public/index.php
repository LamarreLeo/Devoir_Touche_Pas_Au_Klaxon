<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

// Configuration de la base de données
use Database\Database;

$config = require __DIR__ . "/../config/config.php";

$db = new Database($config);
$pdo = $db->getPDO();

// Configuration du routeur
use Buki\Router\Router;

session_start();

$router = new Router([
    'base_folder' => '/Devoir_Touche_Pas_Au_Klaxon/PHP/public'
]);

// ROUTE DE TEST PROVISOIR
$router->get('/', function() {
    echo "Le routeur fonctionne correctement !";
});

// DISPATCH
$router->run();
