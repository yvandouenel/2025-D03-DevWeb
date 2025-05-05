<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class ProductController
{
  public function displayOneProduct(ServerRequestInterface $request, array $routeParameters): ResponseInterface
  {

    // je voudrais transformer mon tableau  $routeParameters en chaine de caractères.
    $parameters = implode(",", $routeParameters);
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      "<h1>Affichage d'un produit </h1>" .
        "<p>$parameters</p>"
    );
  }
}
