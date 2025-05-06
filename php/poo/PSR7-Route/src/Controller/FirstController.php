<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class FirstController
{
  public function handleRequest(ServerRequestInterface $request): ResponseInterface
  {
    // Récupération de l'URI et analyse de ses composants
    $uri = $request->getUri();

    $uriComponents = [
      'HTTP Method' => $request->getMethod(),
      'Scheme (protocole)' => $uri->getScheme(),
      'Host (domaine)' => $uri->getHost(),
      'Port' => $uri->getPort() ?: '80/443',
      'Path (chemin)' => $uri->getPath(),
      'Query (paramètres)' => $uri->getQuery(),
      'Fragment (ancre)' => $uri->getFragment(),
      'URI complète' => (string) $uri
    ];

    // Création du contenu HTML pour une meilleure lisibilité
    $html = '<h1>Analyse de l\'URI</h1>';
    $html .= '<ul>';
    foreach ($uriComponents as $name => $value) {
      $html .= sprintf(
        '<li><strong>%s :</strong> %s</li>',
        htmlspecialchars($name),
        htmlspecialchars($value)
      );
    }
    $html .= '</ul>';

    // Création de la réponse
    return new Response(
      200,
      ['Content-Type' => 'text/html; charset=utf-8'],
      $html
    );
  }

  public function testPost(ServerRequestInterface $request): ResponseInterface
  {
    if ($request->getMethod() == "GET") {
      // Création du contenu HTML pour une meilleure lisibilité
      $html = '<h1>Formulaire de test</h1>';
      $html .= '<form method="post" action="/test-post">';
      $html .= '    <div>';
      $html .= '        <label for="firstname">Prénom :</label>';
      $html .= '        <input type="text" id="firstname" name="firstname" required>';
      $html .= '    </div>';
      $html .= '    <div>';
      $html .= '        <label for="lastname">Nom :</label>';
      $html .= '        <input type="text" id="lastname" name="lastname" required>';
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
    } elseif ($request->getMethod() == "POST") {
      // Récupération des données POST en utilisant getParsedBody()
      $postData = $request->getParsedBody();
      // Création du contenu HTML pour une meilleure lisibilité
      $html = '<h1>Résultat du formulaire de test</h1>';
      $html .= '<dl>';
      $html .= ' <dt>Valeur de POST</dt>';
      // Affichage de toutes les données POST
      if (is_array($postData) && !empty($postData)) {
        foreach ($postData as $key => $value) {
          $html .= ' <dd><strong>' . htmlspecialchars($key) . '</strong>: ' . htmlspecialchars($value) . '</dd>';
        }
      } else {
        $html .= ' <dd>Aucune donnée POST reçue</dd>';
      }
      $html .= '</dl>';

      // Création et renvoi de la réponse
      return new Response(
        200,
        ['Content-Type' => 'text/html; charset=utf-8'],
        $html
      );
    }
  }
  public function testPut(ServerRequestInterface $request, array $routeParams = []): ResponseInterface
  {
    error_log("Dans testPut");
    if ($request->getMethod() == "GET") {
      $html = $this->createPutFormJs();
      // Création de la réponse
      return new Response(
        200,
        ['Content-Type' => 'text/html; charset=utf-8'],
        $html
      );
    } elseif ($request->getMethod() == "PUT") {
      error_log("Dans testPut avec reconnaisance de la méthode put");
      // Récupération de l'ID depuis les paramètres de route
      $id = $routeParams['id'] ?? null;
      error_log("id :  $id");
      // Récupération du corps de la requête (données JSON envoyées)
      $body = $request->getBody()->getContents();
      $data = json_decode($body, true);

      // Validation simple
      if ($id === null) {
        return $this->createJsonResponse([
          'success' => false,
          'message' => 'ID non spécifié'
        ], 400);
      }

      // Simulez ici le traitement de mise à jour
      // Dans un cas réel, vous interagiriez avec une base de données

      // Création d'une réponse de succès
      return $this->createJsonResponse([
        'success' => true,
        'message' => 'Mise à jour effectuée avec succès',
        'data' => [
          'id' => $id,
          'received' => $data,
          'timestamp' => time()
        ]
      ]);
    }
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
  private function createPutFormJs()
  {
    // Création du contenu HTML pour le formulaire avec JavaScript
    return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de mise à jour</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    input, textarea {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      cursor: pointer;
    }
    .success {
      color: green;
      background-color: #e7f7e7;
      padding: 10px;
      border-radius: 5px;
      margin-top: 15px;
    }
    .error {
      color: red;
      background-color: #f7e7e7;
      padding: 10px;
      border-radius: 5px;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <h1>Mise à jour de ressource</h1>
  
  <form id="updateForm">
    <div class="form-group">
      <label for="resourceId">ID de la ressource :</label>
      <input type="number" id="resourceId" required>
    </div>
    
    <div class="form-group">
      <label for="name">Nom :</label>
      <input type="text" id="name" required>
    </div>
    
    <div class="form-group">
      <label for="description">Description :</label>
      <textarea id="description" rows="4"></textarea>
    </div>
    
    <button type="submit">Mettre à jour</button>
  </form>
  
  <div id="responseMessage"></div>

  <script>
    // Fonction pour envoyer une requête PUT à l'API
    function updateResource(id, data) {
      console.log("dans updateResource", `/test-put/\${id}`);
      return fetch(`/test-put/\${id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(data)
      })
      .then(response => {
        if (!response.ok) {
          throw new Error(`Erreur HTTP: \${response.status}`);
        }
        return response.json();
      });
    }

    document.getElementById('updateForm').addEventListener('submit', function(event) {
      event.preventDefault();
      console.log(`Validation du formulaire`);
      const id = document.getElementById('resourceId').value;
      const name = document.getElementById('name').value;
      const description = document.getElementById('description').value;
      
      const data = {
        name: name,
        description: description,
        updated_at: new Date().toISOString()
      };
      
      updateResource(id, data)
        .then(result => {
          console.log('Mise à jour réussie:', result);
          document.getElementById('responseMessage').textContent = 'Mise à jour réussie !';
          document.getElementById('responseMessage').className = 'success';
        })
        .catch(error => {
          console.error('Erreur lors de la mise à jour:', error);
          document.getElementById('responseMessage').textContent = `Erreur: \${error.message}`;
          document.getElementById('responseMessage').className = 'error';
        });
    });
  </script>
</body>
</html>
HTML;
  }
}
