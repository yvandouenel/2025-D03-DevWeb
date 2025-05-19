<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Services\NavigationService;
use Diginamic\Framework\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class AdminController extends Controller
{
  public function __construct(NavigationService $navService)
  {
    $this->navService = $navService;
  }
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    $title = "Administration";
    $links = $this->navService->routesToLinks('/admin');
    $html = View::header($links);
    $html .= "<h1>$title</h1>";
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      View::baseTemplate($title, $html)
    );
  }
}
