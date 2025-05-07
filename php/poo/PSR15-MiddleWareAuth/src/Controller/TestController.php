<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class TestController
{
  public function test(ServerRequestInterface $request): ResponseInterface
  {
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Page de test</h1>'
    );
  }
}
