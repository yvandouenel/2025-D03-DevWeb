<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class PatchController
{
  public function testPatch(ServerRequestInterface $request): ResponseInterface
  {
    if ($request->getMethod() == "GET") {
      return new Response(
        200,
        ['Content-Type' => 'text/html'],
        $this->generateHTMLJs()
      );
    } else if ($request->getMethod() == "PATCH") {
      return $this->createJsonResponse([
        'success' => true,
        'message' => 'Mise à jour effectuée avec succès',
        'data' => [
          'msg' => "todo bene",
          'timestamp' => time()
        ]
      ]);
    }
  }
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
  private function generateHTMLJs()
  {
    $htmlJs = <<<HTML
    <!DOCTYPE html>
    <html lang="fr">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Test PATCH</title>
      </head>
      <body>
        <h1>Test Patch</h1>
        <button id="btn-api">Tester API</button>
        <script>
          console.log(`Dans le script qui va utiliser fecth`);
          // Récupération de la référence du bouton
          const btn = document.getElementById("btn-api");
          // Ajout d'un gestionnaire d'événément
          btn.addEventListener("click",(event)=>{
            console.log(`bouton cliqué`);
            // Appel du endpoint (api) via fetch
            fetch("/test-patch", {
              method: 'PATCH',
              headers: {
                'Content-Type': 'application/json',
              }
            })
            .then((response)=>{
              console.log(`statut :`, response.status);
              return response.json();
            })
            .then((data)=>{
              console.log(`data : `, data);
            })
            .catch(error => {
              console.log(`Erreur attrapée dans fetch test-patch` + error);
            });
          })
        </script>
      </body>
    </html>
    HTML;

    return $htmlJs;
  }
}
