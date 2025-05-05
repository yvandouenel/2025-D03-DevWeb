<?php

require_once 'vendor/autoload.php';

use Diginamic\Framework\Router\Router;
use Diginamic\Framework\Response\ResponseEmitter;
use Diginamic\Framework\Exception\RouteNotFoundException;
use GuzzleHttp\Psr7\ServerRequest;

$router = new Router();
// Chargement des routes depuis le fichier routes.php
$routes = require_once __DIR__ . '/src/Router/routes.php';

// Parcours du tableau de routes et ajout de chaque route au router
foreach ($routes as $route) {
  $router->addRoute(
    $route['path'],
    $route['controller'],
    $route['controllerMethod'],
    $route['httpMethod']
  );
}

// Traitement de la requête actuelle
$request = ServerRequest::fromGlobals();
$emitter = new ResponseEmitter();

try {
  // Dispatch de la route
  $route = $router->dispatch($request);

  // Instanciation du controller
  $controller = new $route['controller']();
  $method = $route['method'];

  // On passe les paramètres en second argument
  $response = $controller->$method($request, $route['params'] ?? []);
  $emitter->emit($response);
} catch (RouteNotFoundException $e) {
  // Gestion de l'erreur 404
  $response = new GuzzleHttp\Psr7\Response(
    404,
    ['Content-Type' => 'text/html'],
    '<h1>404 - Page non trouvée</h1>'
  );
  $emitter->emit($response);
}
