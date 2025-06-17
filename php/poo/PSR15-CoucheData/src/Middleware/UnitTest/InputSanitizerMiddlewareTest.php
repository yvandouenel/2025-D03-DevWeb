<?php

use Diginamic\Framework\Middleware\InputSanitizerMiddleware;
use PHPUnit\Framework\TestCase;
use \Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

class InputSanitizerMiddlewareTest extends TestCase
{
  /**
   * Méthode qui teste que les balises HTML sont bien supprimées
   * Pour cela on "moke" une première requête : ($mockRequest) avec les méthodes :
   *    - getUri
   *    - getQueryParams
   *    - getParsedBody
   *  - une uri
   * Ensuite on "moke" une deuxième requête $sanitizedRequest car un middleware ne doit pas supprimer une requête http mais peut en créer une nouvelle à partir de celle qu'il reçoit.
   * On teste que :
   *  - next reçoit bien la requête nettoyée
   *  - le middleware de sanitizing renvoie bien la réponse du middleware suivant sans la modifier
   *  - le champ comment de la requête existe bien
   *  - la valeur du champ "comment" ne comprend plus la balise <script>
   * 
   * @return void
   */
  public function testRemoveScriptTagFromBody()
  {
    // 1. PRÉPARATION : Créer le middleware avec l'option pour supprimer les balises HTML
    $middleware = new InputSanitizerMiddleware(['strip_tags' => true]);

    // 2. CRÉER UNE FAUSSE REQUÊTE HTTP
    // On simule une requête qui contient du JavaScript malveillant
    $mockRequest = $this->createMock(ServerRequestInterface::class);

    // Simuler l'URL de la requête (/test)
    $mockUri = $this->createMock(UriInterface::class);
    $mockUri->method('getPath')->willReturn('/test');
    $mockRequest->method('getUri')->willReturn($mockUri);

    // Pas de paramètres dans l'URL
    $mockRequest->method('getQueryParams')->willReturn([]);

    // IMPORTANT : Le corps de la requête contient du JavaScript dangereux
    $mockRequest->method('getParsedBody')->willReturn([
      'comment' => '<script>alert("xss")</script>Hello'
    ]);

    // 3. CAPTURER LES DONNÉES NETTOYÉES
    // Variable pour stocker les données nettoyées
    $capturedCleanData = null;

    // Simuler une nouvelle requête qui sera créée après nettoyage
    $sanitizedRequest = $this->createMock(ServerRequestInterface::class);

    // Le middleware va d'abord nettoyer les paramètres de l'URL (vides ici)
    $mockRequest->method('withQueryParams')->willReturn($sanitizedRequest);

    // IMPORTANT : Capturer les données qui sont passées à withParsedBody
    $sanitizedRequest
      ->method('withParsedBody')
      ->willReturnCallback(function ($cleanData) use (&$capturedCleanData, $sanitizedRequest) {
        // Sauvegarder les données nettoyées pour les vérifier plus tard
        $capturedCleanData = $cleanData;
        return $sanitizedRequest;
      });

    // 4. CRÉER LA FONCTION "SUIVANTE" DU MIDDLEWARE
    // Cette fonction simule le middleware suivant dans la chaîne
    $mockResponse = $this->createMock(ResponseInterface::class);

    $next = function ($request) use ($sanitizedRequest, $mockResponse) {
      // Vérifier qu'on reçoit bien la requête nettoyée (pas l'originale)
      $this->assertSame($sanitizedRequest, $request);

      return $mockResponse;
    };

    // 5. EXÉCUTION : Faire passer la requête dans notre middleware
    $result = $middleware->process($mockRequest, $next);

    // 6. VÉRIFICATIONS 
    /* Un middleware de sanitisation ne doit que nettoyer la requête, pas modifier la réponse.  */
    $this->assertSame($mockResponse, $result, 'Le middleware doit retourner la réponse du middleware suivant');

    // ASSERTION PRINCIPALE : Vérifier que la balise <script> a été supprimée
    $this->assertNotNull($capturedCleanData, 'Les données nettoyées doivent être capturées');
    $this->assertArrayHasKey('comment', $capturedCleanData, 'Le champ comment doit exister');

    // Vérifier que le JavaScript dangereux a été supprimé
    $this->assertEquals(
      'alert(\"xss\")Hello',
      $capturedCleanData['comment'],
      'La balise <script> doit être supprimée, ne laissant que "alert("xss")Hello"'
    );

    // Vérifier explicitement que <script> n'est plus présent
    $this->assertStringNotContainsString(
      '<script>',
      $capturedCleanData['comment'],
      'Aucune balise <script> ne doit rester dans les données nettoyées'
    );
  }
}
