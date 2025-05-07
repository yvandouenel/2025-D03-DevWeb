<?php

use Diginamic\Framework\Controller\HomeController;
use Diginamic\Framework\Controller\FirstController;
use Diginamic\Framework\Controller\AdminController;
use Diginamic\Framework\Controller\ContactController;
use Diginamic\Framework\Controller\LoginController;
use Diginamic\Framework\Controller\TestController;
use Diginamic\Framework\Middleware\AuthMiddleware;
use Diginamic\Framework\Middleware\TimeMiddleware;

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
    'middlewares' => [
      new TimeMiddleware()
    ]
  ],
  [
    'path' => '/first',
    'controller' => FirstController::class,
    'controllerMethod' => 'index',
    'httpMethod' => 'GET',
    'params' => [],
    'middlewares' => []
  ],
  [
    'path' => '/admin',
    'controller' => AdminController::class, // À changer avec votre contrôleur d'admin
    'controllerMethod' => 'index',
    'httpMethod' => 'GET',
    'params' => [],
    'middlewares' => [
      new AuthMiddleware(['/admin'])
    ]
  ],
  [
    'path' => '/profile/{id}',
    'controller' => HomeController::class, // À changer avec votre contrôleur de profil
    'controllerMethod' => 'showProfile',
    'httpMethod' => 'GET',
    'params' => [
      'id' => '\d+' // Le paramètre id doit être un nombre
    ],
    'middlewares' => [
      new AuthMiddleware(['/profile'])
    ]
  ],
  [
    'path' => '/contact',
    'controller' => ContactController::class,
    'controllerMethod' => 'index',
    'httpMethod' => 'GET',
    'params' => [],
    'middlewares' => [
      // new AuthMiddleware(['/admin'])  // Ceci n'est pas nécessaire car la liste a été ajoutée en début du fichier index.php
    ]
  ],
  [
    'path' => '/contact-post',
    'controller' => ContactController::class,
    'controllerMethod' => 'submitContact',
    'httpMethod' => 'POST',
    'params' => [],
    'middlewares' => [
      // new AuthMiddleware(['/admin'])  // Ceci n'est pas nécessaire car la liste a été ajoutée en début du fichier index.php
    ]
  ],
  [
    'path' => '/contact-success',
    'controller' => ContactController::class,
    'controllerMethod' => 'contactSuccess',
    'httpMethod' => 'GET',
    'params' => [],
    'middlewares' => []
  ],
  [
    'path' => '/login',
    'controller' => LoginController::class,
    'controllerMethod' => 'index',
    'httpMethod' => 'GET',
    'params' => [],
    'middlewares' => []
  ],
  [
    'path' => '/login-post',
    'controller' => LoginController::class,
    'controllerMethod' => 'submitLogin',
    'httpMethod' => 'POST',
    'params' => [],
    'middlewares' => [
      new AuthMiddleware(['/login-post'])
    ]
  ],
  [
    'path' => '/testauth',
    'controller' => TestController::class,
    'controllerMethod' => 'test',
    'httpMethod' => 'GET',
    'params' => [],
    'middlewares' => [
      new AuthMiddleware(['/testauth'])
    ]
  ],
  [
    'path' => '/logout',
    'controller' => LoginController::class,
    'controllerMethod' => 'logout',
    'httpMethod' => 'GET',
    'params' => [],
    'middlewares' => [
      new AuthMiddleware(['/logout'])
    ]
  ],
];
