<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Model\Book;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class BookController
{
  public function getAll(ServerRequestInterface $request): ResponseInterface
  {
    // C'est la reponsabilité du contrôleur d'aller chercher les données 
    // En utilisant le modèle
    // Puis d'afficher en utilisant la vue
    // Utilisation de Book (le modèle) avec ces classes statiques
    $books = Book::getAll();


    return $this->createJsonResponse([
      'success' => true,
      'message' => 'Livres récupérés avec succès',
      'data' => $books
    ]);

    // Doit renvoyer les livres au format json
  }
  public function getOne(ServerRequestInterface $request, array $routeParams): ResponseInterface
  {

    $numBook = $routeParams["id"];
    // C'est la reponsabilité du contrôleur d'aller chercher les données 
    // En utilisant le modèle
    // Puis d'afficher en utilisant la vue
    // Utilisation de Book (le modèle) avec ces classes statiques
    $book = Book::getById($numBook);


    return $this->createJsonResponse([
      'success' => true,
      'message' => 'Livre récupéré avec succès',
      'data' => $book
    ]);

    // Doit renvoyer les livres au format json
  }
  public function postOne(ServerRequestInterface $request): ResponseInterface
  {
    // Récupérer les données envoyées par la requête 
    $newBook = $request->getBody()->getContents();

    // Il faut m'assurer que les données envoyées par la requête http (post) soit transformée en tableau associatif

    $bookArray = json_decode($newBook, true);

    // Ajout du nouveau livre en utlisant le Modèle
    $addedBook = Book::add($bookArray);

    // Renvoie d'une réponse au format json
    return $this->createJsonResponse([
      'success' => true,
      'message' => 'post fait',
      'data' => $addedBook
    ], 200);
  }
  public function deleteOne(ServerRequestInterface $request, array $routeParams): ResponseInterface
  {
    // Récupération de l'id via le tableau $routeParams
    $id = $routeParams["id"];
    // Suppression du livre en utlisant le Modèle
    $bookDeleted = Book::delete($id);

    // Renvoie d'une réponse au format json
    return $this->createJsonResponse([
      'success' => $bookDeleted,
      'message' => 'suppression faite'
    ], 200);
  }
  public function putOne(ServerRequestInterface $request, array $routeParams): ResponseInterface
  {
    // Récupérer les données envoyées par la requête 
    $bookToUpdate = $request->getBody()->getContents();

    // Il faut m'assurer que les données envoyées par la requête http (post) soit transformée en tableau associatif

    $bookArray = json_decode($bookToUpdate, true);

    // Récupération de l'id via le tableau $routeParams
    $id = $routeParams["id"];
    // Suppression du livre en utlisant le Modèle
    $updatedBook = Book::update($id, $bookArray);

    // Renvoie d'une réponse au format json
    return $this->createJsonResponse([
      'success' => true,
      'message' => 'modification faite',
      'updatedBook' => $updatedBook
    ], 200);
  }
  /**
   * Crée une réponse JSON
   */
  private function createJsonResponse(array $data, int $statusCode = 200): ResponseInterface
  {
    return new Response(
      $statusCode,
      [
        'Content-Type' => 'application/json',
        'Access-Control-Allow-Origin' => '*', // Pour le CORS, à ajuster selon vos besoins
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
      ],
      json_encode($data)
    );
  }
}
