<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use Izniburak\Router\Router;

session_start();

// Router
$router = new Router();

// ROUTE DE TEST PROVISOIR
$router->get('/', function() {
    echo "Le routeur fonctionne correctement !";
});

// DISPATCH
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
