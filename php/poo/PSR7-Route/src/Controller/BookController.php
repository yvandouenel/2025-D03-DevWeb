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
