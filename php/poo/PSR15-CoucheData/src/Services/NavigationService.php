<?php

namespace Diginamic\Framework\Services;

use Diginamic\Framework\Middleware\AuthMiddleware;

class NavigationService
{
  // Attributs
  protected array $routes = [];

  public function __construct($routes)
  {
    $this->routes = $routes;
  }

  /**
   * Créer un tableau de liens à afficher dans la navigation en fonction de l'authentification de l'utilisateur
   *
   * @param String $activePath
   * @return Array - les liens 
   */
  public function routesToLinks(string $activePath)
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
