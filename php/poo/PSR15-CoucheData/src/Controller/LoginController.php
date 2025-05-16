<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Views\LoginView;
use Diginamic\Framework\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class LoginController extends Controller
{
  public function __construct(array $routes = [])
  {
    $this->routes = $routes;
  }
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    $title = "Formulaire d'identification";
    $links = $this->routesToLinks('/login');

    $html = View::header($links);
    // Création du contenu HTML pour une meilleure lisibilité
    $html .= LoginView::displayLoginForm($title);

    // Création et renvoi de la réponse
    return new Response(
      200,
      ['Content-Type' => 'text/html; charset=utf-8'],
      View::baseTemplate($title, $html)
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
