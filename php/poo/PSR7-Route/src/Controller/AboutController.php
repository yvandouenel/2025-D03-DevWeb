<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class AboutController
{
  public function testAbout(ServerRequestInterface $request): ResponseInterface
  {
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>A propos</h1>' .
        '<p>Lorem Ipsum</p>'
    );
  }
}
