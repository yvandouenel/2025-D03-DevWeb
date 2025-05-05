<?php

require_once 'vendor/autoload.php';

use Diginamic\Framework\Router\Router;
use Diginamic\Framework\Response\ResponseEmitter;
use Diginamic\Framework\Exception\RouteNotFoundException;
use GuzzleHttp\Psr7\ServerRequest;

// Instanciation du routeur qui s'initialise avec un tableau de routes vide
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
  // Dispatch de la route qui permet de récupérer la route sous forme d'un tableau associatif
  // qui a pour clés : controller, method et params
  $route = $router->dispatch($request);

  // Instanciation dynamique du controller. $route['controller'] représente la valeur de la clé "controller" dans le tableau $route
  $controller = new $route['controller']();

  // $methode stocke la valeur correpondante à la clé méthode
  $method = $route['method'];

  // On appelle la méthode du contrôleur qui correspond à notre route (index, handleRequest ...) à laquelle on passe la requête est les paramètres en second argument
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
