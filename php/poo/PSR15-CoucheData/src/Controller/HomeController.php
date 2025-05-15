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
    $html = View::baseTemplate();
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      $html
    );
  }
}
