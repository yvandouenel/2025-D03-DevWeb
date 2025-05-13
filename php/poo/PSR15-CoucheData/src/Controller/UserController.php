<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Repository\UserRepository;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class UserController
{
  public function findAll(ServerRequestInterface $request): ResponseInterface
  {

    // Connexion à la couche data via le repository
    $userRepository = new UserRepository();

    // Récupération des utilisateurs
    $users = $userRepository->findAll();

    $html = '<ul>';

    // Parcours des utilisateurs
    foreach ($users as $user) {
      $html .= "<li>$user->login</li>";
    }

    $html .= '</ul>';



    // Utilisation des méthodes de UserRepository()

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Utilisateurs </h1>' . $html
    );
  }
}
