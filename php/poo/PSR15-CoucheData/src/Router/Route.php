<?php

namespace Diginamic\Framework\Router;

/**
 * Classe qui représente une route avec son chemin, son controller,
 * sa méthode, sa méthode HTTP et ses middlewares
 */
class Route
{
  private string $path;
  private string $controller;
  private string $controllerMethod;
  private string $httpMethod;
  private array $paramPatterns;
  private array $middlewares = [];

  /**
   * Constructeur de la classe Route
   */
  public function __construct(
    string $path,
    string $controller,
    string $controllerMethod,
    string $httpMethod,
    array $paramPatterns = []
  ) {
    $this->path = $path;
    $this->controller = $controller;
    $this->controllerMethod = $controllerMethod;
    $this->httpMethod = $httpMethod;
    $this->paramPatterns = $paramPatterns;
  }

  /**
   * Définit les middlewares pour cette route
   * 
   * @param array $middlewares
   * @return self
   */
  public function setMiddlewares(array $middlewares): self
  {
    $this->middlewares = $middlewares;
    return $this;
  }

  /**
   * Récupère les middlewares pour cette route
   * 
   * @return array
   */
  public function getMiddlewares(): array
  {
    return $this->middlewares;
  }

  /**
   * Vérifie si la route correspond au chemin donné
   */
  public function matches(string $path): bool
  {
    // Transformation du chemin de la route en expression régulière
    // On remplace les paramètres {param} par des groupes de capture
    $pattern = $this->path;

    // Échapper les caractères spéciaux de regex
    $pattern = preg_quote($pattern, '#');

    // Remplacer les paramètres {param} par des groupes de capture
    $pattern = preg_replace('#\\\{([a-zA-Z0-9_]+)\\\}#', '(?P<$1>[^/]+)', $pattern);

    // Ajouter les délimiteurs et les ancres
    $pattern = '#^' . $pattern . '$#';
    error_log("pattern : " . $pattern . ' - ' . $path);

    return (bool) preg_match($pattern, $path);
  }

  /**
   * Extrait les paramètres du chemin donné
   */
  public function extractParams(string $path): array
  {
    $params = [];

    // Transformation du chemin de la route en expression régulière
    $pattern = $this->path;
    $pattern = preg_quote($pattern, '#');
    $pattern = preg_replace('#\\\{([a-zA-Z0-9_]+)\\\}#', '(?P<$1>[^/]+)', $pattern);
    $pattern = '#^' . $pattern . '$#';

    // Extraction des paramètres
    if (preg_match($pattern, $path, $matches)) {
      foreach ($matches as $key => $value) {
        // Ignorer les clés numériques
        if (!is_numeric($key)) {
          $params[$key] = $value;
        }
      }
    }

    return $params;
  }

  // Getters
  public function getPath(): string
  {
    return $this->path;
  }

  public function getController(): string
  {
    return $this->controller;
  }

  public function getControllerMethod(): string
  {
    return $this->controllerMethod;
  }

  public function getHttpMethod(): string
  {
    return $this->httpMethod;
  }

  public function getParamPatterns(): array
  {
    return $this->paramPatterns;
  }
}
