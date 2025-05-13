<?php

namespace Diginamic\Framework\Router;

use Diginamic\Framework\Exception\RouteNotFoundException;
use Diginamic\Framework\Middleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Classe qui permet :
 *   d'ajouter de nouvelles routes
 *   de renvoyer le bon controller et la bonne méthode en fonction qu'une requête HTTP
 *   d'appliquer des middlewares globaux ou spécifiques à des routes
 */
class Router
{
  /**
   * @var array<Route> Liste des routes
   */
  private array $routes = [];

  /**
   * @var array<MiddlewareInterface> Liste des middlewares globaux
   */
  private array $middlewares = [];

  /**
   * Ajoute une route au routeur
   * 
   * @param string $path Chemin de la route
   * @param string $controller Nom de la classe du contrôleur
   * @param string $controllerMethod Nom de la méthode à appeler
   * @param string $httpMethod Méthode HTTP (GET, POST, etc.)
   * @param array $paramPatterns Patrons pour les paramètres dynamiques
   * @param array $middlewares Middlewares spécifiques à cette route
   */
  public function addRoute(
    string $path,
    string $controller,
    string $controllerMethod,
    string $httpMethod,
    array $paramPatterns = [],
    array $middlewares = []
  ): void {
    $route = new Route($path, $controller, $controllerMethod, $httpMethod, $paramPatterns);
    $route->setMiddlewares($middlewares);
    $this->routes[] = $route;
  }

  /**
   * Ajoute un middleware global qui s'appliquera à toutes les routes
   * 
   * @param MiddlewareInterface $middleware
   * @return self
   */
  public function addMiddleware(MiddlewareInterface $middleware): self
  {
    $this->middlewares[] = $middleware;
    return $this;
  }

  /**
   * Retourne la liste des middlewares globaux
   * 
   * @return array<MiddlewareInterface>
   */
  public function getMiddlewares(): array
  {
    return $this->middlewares;
  }

  /**
   * Traite une requête et trouve la route correspondante
   * 
   * @param ServerRequestInterface $request
   * @return array Informations sur la route (controller, method, params, middlewares)
   * @throws RouteNotFoundException Si aucune route ne correspond
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

        // Combiner les middlewares globaux et les middlewares spécifiques à la route
        $allMiddlewares = array_merge($this->middlewares, $route->getMiddlewares());

        return [
          'controller' => $route->getController(),
          'controllerMethod' => $route->getControllerMethod(),
          'params' => $params,
          'middlewares' => $allMiddlewares
        ];
      }
    }

    error_log("Aucune route trouvée pour: " . $path);
    throw new RouteNotFoundException('No route found for ' . $path);
  }

  /**
   * Charge les routes à partir d'un fichier de configuration
   * 
   * @param string $routesFile
   */
  public function loadRoutes(string $routesFile): void
  {
    $routes = require $routesFile;

    foreach ($routes as $routeConfig) {
      $paramPatterns = $routeConfig['params'] ?? [];
      $middlewares = $routeConfig['middlewares'] ?? [];

      $this->addRoute(
        $routeConfig['path'],
        $routeConfig['controller'],
        $routeConfig['controllerMethod'],
        $routeConfig['httpMethod'],
        $paramPatterns,
        $middlewares
      );
    }

    error_log("Routes chargées: " . count($this->routes));
  }
}
