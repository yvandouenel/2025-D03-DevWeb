<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Services\NavigationService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Twig\Environment;

class HomeController extends Controller
{
  // Il faut créer un constructeur qui va récupérer les routes (dans les paramètres)
  // On stocke les routes dans un attribut $routes
  // on crée une méthode qui permet de créer le tableau links à partir de $routes

  public function __construct(NavigationService $navService, Environment $twig)
  {
    $this->navService = $navService;
    $this->twig = $twig;
  }
  public function index(ServerRequestInterface $request): ResponseInterface
  {

    $html = $this->twig->render('home/index.twig', [
      'title' => "Bienvenue sur notre site web",
      'links' => $this->navService->routesToLinks('/'),
      'date' => date(DATE_ATOM, strtotime('now'))
    ]);

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      $html
    );
  } //View::baseTemplate("Accueil", $html)
}
