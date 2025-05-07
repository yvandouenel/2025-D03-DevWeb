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
  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    // Créer une fonction qui exécute le contrôleur final
    $core = function (ServerRequestInterface $request) {
      return call_user_func($this->controller, $request);
    };

    // Envelopper chaque middleware autour du noyau, comme un oignon
    $pipeline = array_reduce(
      array_reverse($this->middlewares),
      function ($next, MiddlewareInterface $middleware) {
        return function (ServerRequestInterface $request) use ($middleware, $next) {
          return $middleware->process($request, $next);
        };
      },
      $core
    );

    // Exécuter le pipeline
    return $pipeline($request);
  }
}
