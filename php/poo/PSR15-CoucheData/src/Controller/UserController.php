<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Model\User;
use Diginamic\Framework\Repository\UserRepository;
use Diginamic\Framework\Services\NavigationService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Twig\Environment;

class UserController extends Controller
{
  // Attributs
  private $userRepository;

  public function __construct(NavigationService $navService, Environment $twig)
  {
    $this->userRepository = new UserRepository();
    $this->navService = $navService;
    $this->twig = $twig;
  }
  public function findAll(ServerRequestInterface $request): ResponseInterface
  {

    $title = "Administration des utilisateurs";
    // Récupération des utilisateurs de type Model\User car c'est le repository (ici AbstractRepository) qui fait la 
    // correspondance (mapping) entre la base de données et le "Model" objet.
    $users = $this->userRepository->findAll();

    $html = $this->twig->render('users/index.twig', [
      'title' => $title,
      'links' => $this->navService->routesToLinks('/users'),
      'users' => $users
    ]);

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      $html
    );
  }
  public function findOne(ServerRequestInterface $request, array $routeParams = []): ResponseInterface
  {

    $title = "Vue d'un utilisateur";
    // Récupération de l'id qui provient de la requête (le paramètre de la route)
    $id = $routeParams["id"];
    if (isset($id)) {

      $user = $this->userRepository->findById($id);

      $html = $this->twig->render('users/oneUser.twig', [
        'title' => $title,
        'links' => $this->navService->routesToLinks('/users'),
        'user' => $user
      ]);

      return new Response(
        200,
        ['Content-Type' => 'text/html'],
        $html
      );
    }
    return new Response(
      400,
      ['Content-Type' => 'text/html'],
      "<h1>Utilisateur inconnu</h1>"
    );
  }

  public function displayAddForm(ServerRequestInterface $request): ResponseInterface
  {

    $title =  "Ajout d'un utilisateur";
    $html = $this->twig->render('users/addForm.twig', [
      'title' => $title,
      'links' => $this->navService->routesToLinks('/'),

    ]);



    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      $html
    );
  }

  public function add(ServerRequestInterface $request): ResponseInterface
  {
    // Récupération des données du formulaire dans le cadre du PSR-7 qui utilise les objets request et response
    $data = $request->getParsedBody();

    // Création de l'entité User
    $userEntity = new User();

    // Hydratation de l'utilisation
    $userEntity->hydrate($data);


    // Appel au modèle ou au repository
    $this->userRepository->save($userEntity);



    // Si tout s'est bien passé, on redirige
    return new Response(
      302,
      ['Location' => '/users'],
      ''
    );
  }
  public function delete(ServerRequestInterface $request, array $routeParams = []): ResponseInterface
  {
    // Récupération de l'id qui provient de la requête (le paramètre de la route)
    $id = $routeParams["id"];
    if (isset($id)) {
      $delete = $this->userRepository->delete($id);

      // Modification de la base de données via le modèle donc via le repository
      if (!$delete) {
        return new Response(
          418,
          ['Content-Type' => 'text/html'],
          '<h1>Problème dans la suppression de l\'utilisateur </h1>'
        );
      }
      // Quand la suppression a bien eu lieu, on redirige
      // Quand tout se passe bien (utilisateur mis à jour), je veux faire une redirection vers /users
      return new Response(
        302,
        ['Location' => '/users'],
        ''
      );
    }
    return new Response(
      400,
      ['Content-Type' => 'text/html'],
      '<h1>La requête HTTP a été mal formulée </h1>'
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
      // Quand tout se passe bien (utilisateur mis à jour), je veux faire une redirection vers /users
      return new Response(
        302,
        ['Location' => '/users'],
        ''
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

    $title = "Modification d'un utilisateur";
    if (isset($id)) {

      // Récupération des données de l'utilisateur à modifier en passant par le repository
      $user = $this->userRepository->findById($id);

      $html = $this->twig->render('users/updateForm.twig', [
        'title' => $title,
        'links' => $this->navService->routesToLinks('/users'),
        'user' => $user
      ]);

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
        $html
      );
    }
    return new Response(
      400,
      ['Content-Type' => 'text/html'],
      '<h1>La requête HTTP a été mal forumlée </h1>'
    );
  }
}
