<?php

namespace Diginamic\Psr7\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class FirstController
{
  public function handleRequest(ServerRequestInterface $request): ResponseInterface
  {
    // Récupération de l'URI et analyse de ses composants
    $uri = $request->getUri();

    $uriComponents = [
      'Scheme (protocole)' => $uri->getScheme(),
      'Host (domaine)' => $uri->getHost(),
      'Port' => $uri->getPort() ?: '80/443',
      'Path (chemin)' => $uri->getPath(),
      'Query (paramètres)' => $uri->getQuery(),
      'Fragment (ancre)' => $uri->getFragment(),
      'URI complète' => (string) $uri
    ];
    // Création du contenu HTML pour une meilleure lisibilité

    $html = '<h1>Analyse de l\'URI</h1>';

    $html .= '<ul>';

    foreach ($uriComponents as $name => $value) {
      $html .= sprintf(
        '<li><strong>%s :</strong> %s</li>',
        htmlspecialchars($name),
        htmlspecialchars($value)
      );
    }
    $html .= '</ul>';

    // Création de la réponse
    $response = new Response(
      200,
      ['Content-Type' => 'text/html; charset=utf-8'],
      $html
    );
    return $response;
  }
}
