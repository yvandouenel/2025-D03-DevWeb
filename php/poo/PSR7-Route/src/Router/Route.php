<?php

namespace Diginamic\Framework\Router;

class Route
{
  private string $path;
  private string $controller;
  private string $controllerMethod;
  private string $httpMethod;
  private array $paramPatterns;

  public function __construct(string $path, string $controller, string $controllerMethod, string $httpMethod, array $paramPatterns = [])
  {
    $this->path = $path;
    $this->controller = $controller;
    $this->controllerMethod = $controllerMethod;
    $this->httpMethod = $httpMethod;
    $this->paramPatterns = $paramPatterns;
  }

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

  /**
   * Vérifie si la route correspond au chemin demandé
   */
  public function matches(string $requestPath): bool
  {
    // Si la route ne contient pas de paramètres, comparaison directe
    if (strpos($this->path, '{') === false) {
      return $this->path === $requestPath;
    }

    // Sinon, conversion du pattern en expression régulière
    $pattern = $this->getRegexPattern();
    error_log("Pattern regex: " . $pattern);

    return (bool) preg_match($pattern, $requestPath);
  }

  /**
   * Extrait les paramètres de l'URL
   */
  public function extractParams(string $requestPath): array
  {
    $params = [];

    // Si la route ne contient pas de paramètres, retourne un tableau vide
    if (strpos($this->path, '{') === false) {
      return $params;
    }

    // Sinon, extraction des paramètres avec l'expression régulière
    $pattern = $this->getRegexPattern();

    if (preg_match($pattern, $requestPath, $matches)) {
      foreach ($matches as $key => $value) {
        if (is_string($key)) {
          $params[$key] = $value;
        }
      }
    }

    return $params;
  }

  /**
   * Convertit le chemin de la route en expression régulière
   */
  private function getRegexPattern(): string
  {
    $pattern = $this->path;

    // Remplacer les paramètres {param} par des groupes de capture nommés
    $pattern = preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function ($matches) {
      $paramName = $matches[1];
      // Utiliser le pattern spécifique s'il existe, sinon utiliser un pattern par défaut
      $regex = $this->paramPatterns[$paramName] ?? '[^/]+';
      return '(?P<' . $paramName . '>' . $regex . ')';
    }, $pattern);

    return '@^' . $pattern . '$@D';
  }
}
