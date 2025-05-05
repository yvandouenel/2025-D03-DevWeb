<?php

namespace Diginamic\Framework\Router;

use Diginamic\Framework\Exception\RouteNotFoundException;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Classe qui permet :
 *   d'ajouter de nouvelles routes
 *   de renvoyer le bon controller et la bonne méthode en fonction qu'une requête HTTP
 */
class Router
{
  private array $routes = [];

  /**
   * Ajoute une route au routeur
   */
  public function addRoute(string $path, string $controller, string $controllerMethod, string $httpMethod, array $paramPatterns = []): void
  {
    $this->routes[] = new Route($path, $controller, $controllerMethod, $httpMethod, $paramPatterns);
  }

  /**
   * Traite une requête et trouve la route correspondante
   */
  public function dispatch(ServerRequestInterface $request): array
  {
    error_log("Dans dispatch");
    $path = $request->getUri()->getPath();
    $httpMethod = $request->getMethod();

    error_log("Dans dispatch - Path: " . $path . ", Method: " . $httpMethod);

    foreach ($this->routes as $route) {
      error_log("Vérification route: " . $route->getPath() . " [" . $route->getHttpMethod() . "]");

      // Vérifie si la route correspond au chemin et à la méthode HTTP
      if ($route->matches($path) && ($httpMethod == $route->getHttpMethod())) {
        error_log("Route trouvée: " . $route->getPath());

        // Extraction des paramètres de l'URL si nécessaire
        $params = $route->extractParams($path);
        error_log("Paramètres extraits: " . json_encode($params));

        return [
          'controller' => $route->getController(),
          'method' => $route->getControllerMethod(),
          'params' => $params
        ];
      }
    }

    error_log("Aucune route trouvée pour: " . $path);
    throw new RouteNotFoundException('No route found for ' . $path);
  }

  /**
   * Charge les routes à partir d'un fichier de configuration
   */
  public function loadRoutes(string $routesFile): void
  {
    $routes = require $routesFile;

    foreach ($routes as $routeConfig) {
      $paramPatterns = $routeConfig['params'] ?? [];
      $this->addRoute(
        $routeConfig['path'],
        $routeConfig['controller'],
        $routeConfig['controllerMethod'],
        $routeConfig['httpMethod'],
        $paramPatterns
      );
    }

    error_log("Routes chargées: " . count($this->routes));
  }
}
