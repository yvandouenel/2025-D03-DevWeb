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


    // Récupération des utilisateurs de type Model\User car c'est le repository (ici AbstractRepository) qui fait la 
    // correspondance (mapping) entre la base de données et le "Model" objet.



    $html = '<ul>';

    $users = $this->userRepository->findAll();

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
  public function displayAddForm(ServerRequestInterface $request): ResponseInterface
  {
    $html = '<form method="post" action="/users/add">';
    $html .= '    <div>';
    $html .= '        <label for="login">Login :</label>';
    $html .= '        <input type="text" id="login" name="login" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="password">Password :</label>';
    $html .= '        <input type="password" id="password" name="password" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="email">Email :</label>';
    $html .= '        <input type="email" id="email" name="email" required>';
    $html .= '    </div>';
    $html .= '    <div style="margin-top: 10px;">';
    $html .= '        <button type="submit">Create</button>';
    $html .= '    </div>';
    $html .= '</form>';

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Ajout d\'un utilisateur </h1>' . $html
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


    // Appel au modèle ou au repository
    $this->userRepository->save($userEntity);



    // Utilisation des méthodes de UserRepository()

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Utilisateur enregistré </h1>'
    );
  }
  public function edit(ServerRequestInterface $request, array $routeParams = [])
  {
    // Récupération de l'id qui provient de la requête (le paramètre de la route)
    $id = $routeParams["id"];
    if (isset($id)) {
      // Récupération des données envoyées (pour modification) par le client via la requête
      $formData = $request->getParsedBody();

      // Création d'une instance de User avec la bonne id
      $user = new User();
      $user->hydrate($formData);
      $user->id = $id;

      // Modification de la base de données via le modèle donc via le repository
      if (!$this->userRepository->save($user)) {
        return new Response(
          418,
          ['Content-Type' => 'text/html'],
          '<h1>Problème dans la mise à jour </h1>'
        );
      }

      return new Response(
        200,
        ['Content-Type' => 'text/html'],
        '<h1>Utilisateur mis à jour </h1>'
      );
    }
    return new Response(
      400,
      ['Content-Type' => 'text/html'],
      '<h1>La requête HTTP a été mal formulée </h1>'
    );


    // Affiche les données du modèle dans un formulaire
  }
  public function displayFormEdit(ServerRequestInterface $request, array $routeParams = [])
  {
    // Récupération de l'id qui provient de la requête (le paramètre de la route)
    $id = $routeParams["id"];
    if (isset($id)) {
      // Récupération des données de l'utilisateur à modifier en passant par le repository
      $user = $this->userRepository->findById($id);

      // Si je n'ai pas d'utilisateur, je renvoie une erreur 404
      if (!$user) {
        return new Response(
          404,
          ['Content-Type' => 'text/html'],
          '<h1>Aucun utilisateur ne correspond ! </h1>'
        );
      }

      return new Response(
        200,
        ['Content-Type' => 'text/html'],
        '<h1>Formulaire de modification : </h1>' . $this->htmlUpdateForm($user)
      );
    }
    return new Response(
      400,
      ['Content-Type' => 'text/html'],
      '<h1>La requête HTTP a été mal forumlée </h1>'
    );


    // Affiche les données du modèle dans un formulaire
  }

  private function htmlUpdateForm($user)
  {
    $html = '<form method="post" action="/users/update/' . $user->id . '">';
    $html .= '    <div>';
    $html .= '        <label for="login">Login :</label>';
    $html .= '        <input type="text" id="login" value="' . $user->login . '" name="login" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="password">Password :</label>';
    $html .= '        <input type="password" id="password" value="' . $user->password . '" name="password" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="email">Email :</label>';
    $html .= '        <input type="email" id="email" value="' . $user->email . '" name="email" required>';
    $html .= '    </div>';
    $html .= '    <div style="margin-top: 10px;">';
    $html .= '        <button type="submit">Modifier</button>';
    $html .= '    </div>';
    $html .= '</form>';

    return $html;
  }
}
