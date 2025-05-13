<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class LoginController
{
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    // Création du contenu HTML pour une meilleure lisibilité
    $html = "<h1>Formulaire d'identification</h1>";
    $html .= '<form method="post" action="/login-post">';
    $html .= '    <div>';
    $html .= '        <label for="login">Votre login :</label>';
    $html .= '        <input type="text" id="login" name="login" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="password">Votre mot de passe :</label>';
    $html .= '        <input type="password" id="password" name="password" required>';
    $html .= '    </div>';
    $html .= '    <div style="margin-top: 10px;">';
    $html .= '        <button type="submit">Envoyer</button>';
    $html .= '    </div>';
    $html .= '</form>';

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

    // Création et renvoi de la réponse
    return new Response(
      200,
      ['Content-Type' => 'text/html; charset=utf-8'],
      $html
    );
  }
}
