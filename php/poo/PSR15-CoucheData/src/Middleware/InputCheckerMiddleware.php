<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class InputCheckerMiddleware implements MiddlewareInterface
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
    // Vérifier si la route actuelle doit être exclue
    $path = $request->getUri()->getPath();


    // Récupérer et vérifier le payload (le body) de la requête POST (login, password, email)
    $parsedBody = $request->getParsedBody();

    // Teste si le mot de passe a bien été envoyé via une condition

    if (isset($parsedBody["password"])) {
      // Vérification du bon format à l'aide des expressions régulières


      // Cas favorable -> je passe au middleware suivant
      return $next($request);

      // Cas défavorable -> je renvoie une réponse avec un code de statut adapté
    } else {
      // Cas défavorable -> je renvoie une réponse avec un code de statut adapté
    }


    // Passer au middleware suivant avec la requête nettoyée
    //
  }
}
