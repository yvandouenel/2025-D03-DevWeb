<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class ContactController
{
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    // Création du contenu HTML pour une meilleure lisibilité
    $html = '<h1>Formulaire de contact</h1>';
    $html .= '<form method="post" action="/contact-post">';
    $html .= '    <div>';
    $html .= '        <label for="email">Votre email :</label>';
    $html .= '        <input type="email" id="email" name="email" required>';
    $html .= '    </div>';
    $html .= '    <div style="margin-top: 10px;">';
    $html .= '        <label for="message">Votre message :</label>';
    $html .= '        <textarea id="message" name="message" rows="5" cols="30" required></textarea>';
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
  }
  public function submitContact(ServerRequestInterface $request): ResponseInterface
  {
    // Récupération des données du formulaire
    $formData = $request->getParsedBody();

    /* L'opérateur de fusion null (null coalescing operator) en PHP.
      Introduit en PHP 7, cet opérateur ?? permet de vérifier si une variable existe et n'est pas null. 
      Si la variable à gauche de l'opérateur existe et n'est pas null, sa valeur est retournée. Sinon, c'est la valeur à droite de l'opérateur qui est retournée.
    */
    $email = $formData['email'] ?? '';
    $message = $formData['message'] ?? '';

    error_log("message : " . $message);

    // Traitement des données (envoi d'email, sauvegarde en base de données, etc.)

    // Redirection ou affichage d'une page de confirmation
    /*  return new Response(
      302,
      ['Location' => '/contact-success'],
      null
    ); */
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Page d\'accueil</h1>' . "message = $message"
    );
  }
  public function contactSuccess(ServerRequestInterface $request): ResponseInterface
  {
    // Création du contenu HTML pour une meilleure lisibilité
    $html = '<h1>Votre demande de contact a bien été transmise avec les données correspondantes</h1>';
    $html .= '<p>';
    $html .= '    Nos équipes vous répondrons très prochainement';
    $html .= '</p>';

    // Création et renvoi de la réponse
    return new Response(
      200,
      ['Content-Type' => 'text/html; charset=utf-8'],
      $html
    );
  }
}
