<?php

namespace Diginamic\Framework\Response;

use Psr\Http\Message\ResponseInterface;

class ResponseEmitter
{
  public function emit(ResponseInterface $response): void
  {
    // Headers de sécurité par défaut
    $defaultHeaders = [
      'X-Content-Type-Options' => 'nosniff',
      'X-Frame-Options' => 'DENY',
      'X-XSS-Protection' => '1; mode=block',
      'Cache-Control' => 'no-store, no-cache, must-revalidate',
      'Pragma' => 'no-cache',
      'Expires' => '0',
      'X-Session-Duration' => ini_get('session.gc_maxlifetime'),
      'X-Cookie-Duration' => ini_get('session.cookie_lifetime')
    ];
    // Ajoute les headers par défaut s'ils ne sont pas déjà définis
    foreach ($defaultHeaders as $name => $value) {
      if (!$response->hasHeader($name)) {
        header("$name: $value");
      }
    }

    // Envoie les headers
    foreach ($response->getHeaders() as $name => $values) {
      foreach ($values as $value) {
        error_log("Header value: " . $value);
        header(sprintf('%s: %s', $name, $value), false);
      }
    }

    // Envoie le status code
    header(sprintf(
      'HTTP/%s %s %s',
      $response->getProtocolVersion(),
      $response->getStatusCode(),
      $response->getReasonPhrase()
    ));

    // Envoie le corps de la réponse
    echo $response->getBody();
  }
}
