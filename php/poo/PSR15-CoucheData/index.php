<?php

require_once 'vendor/autoload.php';

use Diginamic\Framework\Router\Router;
use Diginamic\Framework\Response\ResponseEmitter;
use Diginamic\Framework\Exception\RouteNotFoundException;
use Diginamic\Framework\Middleware\MiddlewareHandler;
use Diginamic\Framework\Middleware\AuthMiddleware;
use Diginamic\Framework\Middleware\InputSanitizerMiddleware;
use Diginamic\Framework\Services\NavigationService;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;

// Démarrer la session si vous utilisez les sessions pour l'authentification
session_start();

// Chemins relatifs à la racine du projet
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/src/templates');
$twig = new \Twig\Environment($loader, [
  'cache' => __DIR__ . '/cache/twig', // Assurez-vous que ce dossier existe et est accessible en écriture
  'debug' => true // Activez le mode debug pendant le développement
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

// Chargement des variables d'environnement
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

// Ajout d'un middleware global d'authentification
// Avec la liste des routes protégées
$authMiddleware = new AuthMiddleware([
  '/profile',
  '/login-post',
  '/users',
  // Ajoutez ici d'autres routes protégées
]);
$router->addMiddleware($authMiddleware);

// Après le middleware d'authentification

// Ajout d'un middleware global pour la sécurisation des entrées
$inputSanitizerMiddleware = new InputSanitizerMiddleware([
  'strip_tags' => true,
  'allow_html' => ['p', 'strong', 'em'], // Balises HTML autorisées, si nécessaire
  'excluded_keys' => ['password', 'csrf_token'], // Clés à exclure du nettoyage
  'excluded_routes' => ['/api/webhook'] // Routes à exclure si nécessaire
]);
$router->addMiddleware($inputSanitizerMiddleware);

// Chargement des routes depuis le fichier routes.php
$routes = require_once __DIR__ . '/src/Router/routes.php';

// Instanciation des services
$navService = new NavigationService($routes);

// Parcours du tableau de routes et ajout de chaque route au router
foreach ($routes as $route) {
  $middlewares = $route['middlewares'] ?? [];
  $paramPatterns = $route['params'] ?? [];

  $router->addRoute(
    $route['path'],
    $route['controller'],
    $route['controllerMethod'],
    $route['httpMethod'],
    $paramPatterns,
    $middlewares
  );
}

// Traitement de la requête actuelle
$request = ServerRequest::fromGlobals();
$emitter = new ResponseEmitter();

try {
  // Dispatch de la route
  $route = $router->dispatch($request);

  // Préparation du gestionnaire de middleware
  $middlewareHandler = new MiddlewareHandler();

  // Ajout des middlewares de la route
  foreach ($route['middlewares'] as $middleware) {
    $middlewareHandler->addMiddleware($middleware);
  }

  // Définition du contrôleur comme fonction finale avec instanciation du contrôleur en fonction de la route
  $controller = new $route['controller']($navService, $twig);
  $method = $route['controllerMethod'];

  $middlewareHandler->setController(function ($request) use ($controller, $method, $route) {
    return $controller->$method($request, $route['params'] ?? []);
  });

  // Exécution de la chaîne de middlewares
  $response = $middlewareHandler->handle($request);

  $emitter->emit($response);
} catch (RouteNotFoundException $e) {
  // Gestion de l'erreur 404
  $response = new Response(
    404,
    ['Content-Type' => 'text/html'],
    '<h1>404 - Page non trouvée</h1>'
  );
  $emitter->emit($response);
}
