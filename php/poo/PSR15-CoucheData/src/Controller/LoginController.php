<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Services\NavigationService;
use Diginamic\Framework\Views\LoginView;
use Diginamic\Framework\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Twig\Environment;

class LoginController extends Controller
{
  public function __construct(NavigationService $navService, Environment $twig)
  {
    $this->navService = $navService;
    $this->twig = $twig;
  }
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    $title = "Formulaire d'identification";

    $html = $this->twig->render('login/formLogin.twig', [
      'title' => $title,
      'links' => $this->navService->routesToLinks('/login'),
    ]);

    // Création et renvoi de la réponse
    return new Response(
      200,
      ['Content-Type' => 'text/html; charset=utf-8'],
      $html
    );
  }
  public function submitLogin(ServerRequestInterface $request): ResponseInterface
  {
    // Récupération des données du formulaire
    $formData = $request->getParsedBody();

    /* L'opérateur de fusion null (null coalescing operator) en PHP.
      Introduit en PHP 7, cet opérateur ?? permet de vérifier si une variable existe et n'est pas null. 
      Si la variable à gauche de l'opérateur existe et n'est pas null, sa valeur est retournée. Sinon, c'est la valeur à droite de l'opérateur qui est retournée.
    */
    $login = $formData['login'] ?? '';
    $password = $formData['password'] ?? '';

    error_log("login : " . $login);
    error_log("password : " . $password);


    $html = "<h1>Identification réussie</h1>";
    $html .= '<p>';
    $html .= '    votre login : ' . $login;
    $html .= '</p>';

    // Si tout s'est bien passé, on redirige
    return new Response(
      302,
      ['Location' => '/users'],
      ''
    );
  }
}
