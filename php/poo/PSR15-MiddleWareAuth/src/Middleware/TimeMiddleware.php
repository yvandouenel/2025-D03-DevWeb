<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class TimeMiddleware implements MiddlewareInterface
{
  /**
   * Process the request through the middleware
   *
   * @param ServerRequestInterface $request
   * @param callable $next
   * @return ResponseInterface
   */
  public function process(ServerRequestInterface $request, callable $next): ResponseInterface
  {
    // startTime dans la phase aller
    $startTime = microtime(true);


    // Si tout va bien, passez au middleware/contrôleur suivant
    $response =  $next($request);

    // Maintenant que j'ai la réponse, je peux la modifier en calculant le temps entre la phase aller de l'architecture oignon et la phase retour
    $executionTime = microtime(true) - $startTime;
    $response = $response->withHeader('X-Execution-Time', $executionTime);

    // Renvoie la réponse modifiée
    return $response;
  }
}
