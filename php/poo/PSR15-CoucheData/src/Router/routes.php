<?php

use Diginamic\Framework\Controller\HomeController;
use Diginamic\Framework\Controller\LoginController;
use Diginamic\Framework\Controller\UserController;
use Diginamic\Framework\Middleware\AuthMiddleware;

/**
 * Fichier de configuration des routes
 * 
 * Chaque route est définie par :
 * - path : le chemin de la route
 * - controller : la classe du contrôleur
 * - controllerMethod : la méthode du contrôleur à appeler
 * - httpMethod : la méthode HTTP (GET, POST, etc.)
 * - params : (optionnel) les patterns pour les paramètres d'URL
 * - middlewares : (optionnel) les middlewares spécifiques à cette route
 */
return [
  [
    'path' => '/',
    'controller' => HomeController::class,
    'controllerMethod' => 'index',
    'httpMethod' => 'GET',
    'params' => [],
    'titleMenu' => 'Accueil',
    'middlewares' => [
      // Vous pouvez ajouter des middlewares spécifiques à cette route
      // new LoggingMiddleware(),
    ]
  ],

  [
    'path' => '/login',
    'controller' => LoginController::class,
    'controllerMethod' => 'index',
    'httpMethod' => 'GET',
    'params' => [],
    'titleMenu' => 'Identification',
    'middlewares' => [
      // new AuthMiddleware(['/admin'])  // Ceci n'est pas nécessaire car la liste a été ajoutée en début du fichier index.php
    ]
  ],
  [
    'path' => '/login-post',
    'controller' => LoginController::class,
    'controllerMethod' => 'submitLogin',
    'httpMethod' => 'POST',
    'params' => [],
    'titleMenu' => '',
    'middlewares' => [
      // new AuthMiddleware(['/admin'])  // Ceci n'est pas nécessaire car la liste a été ajoutée en début du fichier index.php
    ]
  ],
  [
    'path' => '/users',
    'controller' => UserController::class,
    'controllerMethod' => 'findAll',
    'httpMethod' => 'GET',
    'params' => [],
    'titleMenu' => 'Gestion des utilisateurs',
    'middlewares' => [
      // new AuthMiddleware(['/admin'])  // Ceci n'est pas nécessaire car la liste a été ajoutée en début du fichier index.php
    ]
  ],
  [
    'path' => '/users/add',
    'controller' => UserController::class,
    'controllerMethod' => 'displayAddForm',
    'httpMethod' => 'GET',
    'params' => [],
    'titleMenu' => '',
    'middlewares' => [
      new AuthMiddleware(['/users/add'])
    ]
  ],
  [
    'path' => '/users/add',
    'controller' => UserController::class,
    'controllerMethod' => 'add',
    'httpMethod' => 'POST',
    'params' => [],
    'titleMenu' => '',
    'middlewares' => [
      new AuthMiddleware(['/users/add'])
    ]
  ],
  [
    'path' => '/users/update/{id}',
    'controller' => UserController::class,
    'controllerMethod' => 'displayFormEdit',
    'httpMethod' => 'GET',
    'params' => ['id' => '\d+'],
    'titleMenu' => '',
    'middlewares' => []
  ],
  [
    'path' => '/users/update/{id}',
    'controller' => UserController::class,
    'controllerMethod' => 'edit',
    'httpMethod' => 'POST',
    'params' => ['id' => '\d+'],
    'titleMenu' => '',
    'middlewares' => []
  ],
  [
    'path' => '/users/delete/{id}',
    'controller' => UserController::class,
    'controllerMethod' => 'delete',
    'httpMethod' => 'GET',
    'params' => ['id' => '\d+'],
    'titleMenu' => '',
    'middlewares' => []
  ],

];
