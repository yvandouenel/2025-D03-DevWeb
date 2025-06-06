<?php

use Diginamic\Framework\Middleware\InputSanitizerMiddleware;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

class InputSanitizerMiddlewareTest extends TestCase
{
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
    $mockResponse = $this->createMock(\Psr\Http\Message\ResponseInterface::class);

    $next = function ($request) use ($sanitizedRequest, $mockResponse) {
      // Vérifier qu'on reçoit bien la requête nettoyée (pas l'originale)
      $this->assertSame($sanitizedRequest, $request);
      // Retourner une VRAIE réponse HTTP (pas une string)
      return $mockResponse;
    };

    // 5. EXÉCUTION : Faire passer la requête dans notre middleware
    $result = $middleware->process($mockRequest, $next);

    // 6. VÉRIFICATIONS : S'assurer que le script a été supprimé
    $this->assertSame($mockResponse, $result, 'Le middleware doit retourner la réponse du middleware suivant');

    // ASSERTION PRINCIPALE : Vérifier que la balise <script> a été supprimée
    $this->assertNotNull($capturedCleanData, 'Les données nettoyées doivent être capturées');
    $this->assertArrayHasKey('comment', $capturedCleanData, 'Le champ comment doit exister');

    // Vérifier que le JavaScript dangereux a été supprimé
    $this->assertEquals(
      'alert("xss")Hello',
      $capturedCleanData['comment'],
      'La balise <script> doit être supprimée, ne laissant que "alert("xss")Hello"'
    );

    // Vérifier explicitement que <script> n'est plus présent
    $this->assertStringNotContainsString(
      '<script>',
      $capturedCleanData['comment'],
      'Aucune balise <script> ne doit rester dans les données nettoyées'
    );

    $this->assertStringNotContainsString(
      'alert(',
      $capturedCleanData['comment'],
      'Le code JavaScript malveillant ne doit plus être présent'
    );
  }
}
