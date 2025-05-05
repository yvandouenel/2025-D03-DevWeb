<?php

use Diginamic\Psr7\Controller\FirstController;
use GuzzleHttp\Psr7\ServerRequest;

require_once 'vendor/autoload.php';

// Instanciation d'une requête à partir de la requête du client grâce à l'opérateur de portée (::) qui permet de faire appel à une méthode de classe (static) qui renvoie une instance de requête
$request = ServerRequest::fromGlobals();

// Instanciation du contrôleur
$controller = new FirstController();

// Appel de la méthode handleRequest du contrôleur
$response = $controller->handleRequest($request);

echo $response->getBody();
