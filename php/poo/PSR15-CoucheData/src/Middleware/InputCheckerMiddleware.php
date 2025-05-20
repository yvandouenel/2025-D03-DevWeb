<?php

namespace Diginamic\Framework\Middleware;

use Diginamic\Framework\Services\ServiceLocator;
use GuzzleHttp\Psr7\Response;
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
      /* 
      Ce pattern vérifie que la chaîne de caractères doit contenir au moins : 
        1 caractère spécial (*&@!?$)
        1 chiffre de 0 à 9
        1 lettre de a à z minuscule
        1 lettre de A à Z majuscule
        le tout doit faire au moins 10 caractères
      */
      $pattern = "~(?=.*[*&@!?$])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{10,}~";

      // Cas favorable -> je passe au middleware suivant
      if (preg_match($pattern, $parsedBody["password"])) {
        return $next($request);
      } else {
        // Récupération des services

        // Récupération de l'instance de NavigationService
        $navService = ServiceLocator::get("navService");

        // Récupération de l'instance de twig
        $twig = ServiceLocator::get("twig");

        $html = $twig->render('error/index.twig', [
          'title' => "Erreur d'insertion d'utilisateur",
          'links' => $navService->routesToLinks('/users'),
        ]);

        return new Response(
          400,
          [
            'Content-Type' => 'text/html'
          ],
          $html
        );
      }


      // Cas défavorable -> je renvoie une réponse avec un code de statut adapté
    } else {
      // Cas défavorable -> je renvoie une réponse avec un code de statut adapté
      return new Response(
        400,
        [
          'Content-Type' => 'text/html'
        ],
        "<h1>Erreur d'insertion d'utilisateur</h1>"
      );
    }


    // Passer au middleware suivant avec la requête nettoyée
    //
  }
}
