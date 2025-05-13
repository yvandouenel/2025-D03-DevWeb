<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class HomeController
{
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Page d\'accueil</h1>'
    );
  }
}
