<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface MiddlewareInterface
{
  /**
   * Traite une requête http entrante et retourne une réponse.
   * Délègue éventuellement la création de la réponse à un "gestionnaire"
   *
   * @param ServerRequestInterface $request
   * @param callable $next The next middleware/handler to be called
   * @return ResponseInterface
   */
  public function process(ServerRequestInterface $request, callable $next): ResponseInterface;
}
