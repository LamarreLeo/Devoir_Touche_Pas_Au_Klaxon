<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use Buki\Router\Router;

session_start();

// Router
$router = new Router([
    'base_folder' => '/Devoir_Touche_Pas_Au_Klaxon/PHP/public'
]);

// ROUTE DE TEST PROVISOIR
$router->get('/', function() {
    echo "Le routeur fonctionne correctement !";
});

// DISPATCH
$router->run();
