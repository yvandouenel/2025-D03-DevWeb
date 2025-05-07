<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class MiddlewareHandler
{
  /**
   * @var array Liste des middlewares à exécuter
   */
  private array $middlewares = [];

  /**
   * @var callable La fonction finale à exécuter (généralement le contrôleur)
   */
  private $controller;

  /**
   * Ajoute un middleware à la pile
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
   * Définit le contrôleur final
   *
   * @param callable $controller
   * @return self
   */
  public function setController(callable $controller): self
  {
    $this->controller = $controller;
    return $this;
  }

  /**
   * Exécute la pile de middlewares et le contrôleur final
   *
   * @param ServerRequestInterface $request
   * @return ResponseInterface
   */
  /**
   * Exécute la pile de middlewares et le contrôleur final
   *
   * @param ServerRequestInterface $request
   * @return ResponseInterface
   */
  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    // Initialise la fonction finale (le contrôleur)
    $next = function (ServerRequestInterface $request) {
      return call_user_func($this->controller, $request);
    };

    // Enveloppe chaque middleware autour du contrôleur, du plus profond au plus externe
    foreach (array_reverse($this->middlewares) as $middleware) {
      $next = function (ServerRequestInterface $request) use ($middleware, $next) {
        return $middleware->process($request, $next);
      };
    }
    // Exécute la chaîne complète
    return $next($request);
  }
}
