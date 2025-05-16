<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class HomeController
{
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    $links = [
      [
        'title' => 'Accueil',
        'path' => '/',
        'active' => 'active'
      ],
      [
        'title' => 'Utilisateurs',
        'path' => '/users',
        'active' => ''
      ]
    ];
    $html = View::header($links);
    $html .= "<h1>Page d'accueil</h1>";
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      View::baseTemplate("Accueil", $html)
    );
  }
}
