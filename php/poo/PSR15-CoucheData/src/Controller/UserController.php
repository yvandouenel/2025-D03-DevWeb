<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Model\User;
use Diginamic\Framework\Repository\UserRepository;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class UserController
{
  // Attribut 
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }
  public function findAll(ServerRequestInterface $request): ResponseInterface
  {


    // Récupération des utilisateurs de type Model\User
    $users = $this->userRepository->findAll();

    $html = '<ul>';

    // Parcours des utilisateurs
    foreach ($users as $user) {
      $html .= "<li>$user->login</li>";
      $html .= "<li>$user->password</li>";
      $html .= "<li>$user->email</li>";
      $html .= "<li>$user->createdAt</li>";
    }

    $html .= '</ul>';



    // Utilisation des méthodes de UserRepository()

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Utilisateurs </h1>' . $html
    );
  }
  public function add(ServerRequestInterface $request): ResponseInterface
  {
    // Récupération des données du formulaire dans le cadre du PSR-7 qui utilise les objets request et response
    $data = $request->getParsedBody();
    var_dump($data);

    // Création de l'entité User
    $userEntity = new User();

    // Hydratation de l'utilisation
    $userEntity->hydrate($data);

    var_dump($userEntity);

    // Appel au modèle ou au repository
    $this->userRepository->save($userEntity);



    // Utilisation des méthodes de UserRepository()

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Utilisateur enregistré </h1>'
    );
  }
}
