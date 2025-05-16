<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Middleware\AuthMiddleware;

abstract class Controller
{
  protected array $routes;

  protected function routesToLinks($activePath)
  {
    // Utilisateur authentifié 
    $isAuthenticated = isset($_SESSION['user_authenticated']) && $_SESSION['user_authenticated'];

    $links = [];
    foreach ($this->routes as $route) {
      $hasAuthMiddleware = in_array($route['path'], AuthMiddleware::$globaProtectedRoutes);
      if ($route["titleMenu"] && (!$hasAuthMiddleware || $isAuthenticated)) {
        $links[] = [
          "title" => $route["titleMenu"],
          "path" => $route['path'],
          "active" => ($route['path'] == $activePath) ? " active" : "",
        ];
      }
    }
    return $links;
  }
}
