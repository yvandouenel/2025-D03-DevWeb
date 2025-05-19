<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Services\NavigationService;
use Diginamic\Framework\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class HomeController extends Controller
{
  // Il faut créer un constructeur qui va récupérer les routes (dans les paramètres)
  // On stocke les routes dans un attribut $routes
  // on crée une méthode qui permet de créer le tableau links à partir de $routes

  public function __construct(NavigationService $navService)
  {
    $this->navService = $navService;
  }
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    $links = $this->navService->routesToLinks('/');
    $html = View::header($links);
    $html .= "<h1>Page d'accueil</h1>";
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      View::baseTemplate("Accueil", $html)
    );
  }
}
