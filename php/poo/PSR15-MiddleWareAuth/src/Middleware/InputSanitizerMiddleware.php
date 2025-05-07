<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class InputSanitizerMiddleware implements MiddlewareInterface
{
  /**
   * @var array Options de configuration pour le nettoyage des entrées
   */
  private array $options;

  /**
   * @param array $options Configuration du nettoyage
   */
  public function __construct(array $options = [])
  {
    // Options par défaut
    $defaultOptions = [
      'strip_tags' => true,         // Supprime les balises HTML
      'allow_html' => [],           // Liste des balises HTML autorisées si strip_tags est true
      'trim' => true,               // Supprime les espaces en début et fin
      'sanitize_email' => true,     // Nettoie les adresses email
      'sanitize_numbers' => true,   // Nettoie les entrées numériques
      'escape_sql' => true,         // Échappe les caractères pour prévenir les injections SQL
      'max_length' => null,         // Longueur maximale des chaînes (null = pas de limite)
      'encoding' => 'UTF-8',        // Encodage à utiliser
      'excluded_keys' => [],        // Clés à exclure du nettoyage (ex: ['password', 'token'])
      'excluded_routes' => [],      // Routes à exclure du nettoyage (ex: ['/api/webhook'])
    ];

    $this->options = array_merge($defaultOptions, $options);
  }

  /**
   * Process the request through the middleware
   *
   * @param ServerRequestInterface $request
   * @param callable $next
   * @return ResponseInterface
   */
  public function process(ServerRequestInterface $request, callable $next): ResponseInterface
  {
    // Vérifier si la route actuelle doit être exclue
    $path = $request->getUri()->getPath();
    foreach ($this->options['excluded_routes'] as $excludedRoute) {
      if (strpos($path, $excludedRoute) === 0) {
        return $next($request);
      }
    }

    // Récupérer et nettoyer les paramètres de la requête
    $queryParams = $this->sanitizeData($request->getQueryParams());
    $parsedBody = $this->sanitizeData($request->getParsedBody() ?? []);

    // Créer une nouvelle requête avec les paramètres nettoyés
    $sanitizedRequest = $request
      ->withQueryParams($queryParams)
      ->withParsedBody($parsedBody);

    // Passer au middleware suivant avec la requête nettoyée
    return $next($sanitizedRequest);
  }

  /**
   * Nettoie les données d'entrée récursivement
   *
   * @param mixed $data
   * @return mixed
   */
  private function sanitizeData($data)
  {
    if (is_array($data)) {
      $sanitizedData = [];
      foreach ($data as $key => $value) {
        // Exclure certaines clés (comme les mots de passe) du nettoyage
        if (in_array($key, $this->options['excluded_keys'])) {
          $sanitizedData[$key] = $value;
          continue;
        }

        $sanitizedData[$key] = $this->sanitizeData($value);
      }
      return $sanitizedData;
    }

    // Si c'est une chaîne, appliquer les filtres configurés
    if (is_string($data)) {
      return $this->sanitizeString($data);
    }

    // Pour les autres types de données (int, bool, etc.), les laisser tels quels
    return $data;
  }

  /**
   * Nettoie une chaîne de caractères selon les options configurées
   *
   * @param string $string
   * @return string
   */
  private function sanitizeString(string $string): string
  {
    error_log("DANS sanitizeString ************************************************************");
    // Trim
    if ($this->options['trim']) {
      $string = trim($string);
    }

    // Strip tags
    if ($this->options['strip_tags']) {
      if (empty($this->options['allow_html'])) {
        // Supprimer toutes les balises HTML
        $string = strip_tags($string);
      } else {
        // Autoriser certaines balises HTML
        $allowedTags = '<' . implode('><', $this->options['allow_html']) . '>';
        $string = strip_tags($string, $allowedTags);
      }
    }

    // Échapper les caractères pour éviter les injections SQL
    if ($this->options['escape_sql']) {
      // Notez que ceci est une mesure de sécurité de base
      // Pour une application réelle, utilisez des requêtes préparées
      $string = addslashes($string);
    }

    // Limiter la longueur
    if ($this->options['max_length'] !== null && strlen($string) > $this->options['max_length']) {
      $string = substr($string, 0, $this->options['max_length']);
    }

    // Nettoyage spécifique pour les emails
    if ($this->options['sanitize_email'] && filter_var($string, FILTER_VALIDATE_EMAIL)) {
      $string = filter_var($string, FILTER_SANITIZE_EMAIL);
    }

    // Convertir l'encodage si nécessaire
    if ($this->options['encoding'] !== 'UTF-8' && function_exists('mb_convert_encoding')) {
      $string = mb_convert_encoding($string, $this->options['encoding'], 'auto');
    }

    return $string;
  }

  /**
   * Nettoie spécifiquement les entrées numériques
   *
   * @param mixed $value
   * @return mixed
   */
  private function sanitizeNumber($value)
  {
    if (is_numeric($value)) {
      // Pour les entiers
      if (filter_var($value, FILTER_VALIDATE_INT) !== false) {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
      }

      // Pour les nombres à virgule flottante
      if (filter_var($value, FILTER_VALIDATE_FLOAT) !== false) {
        return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      }
    }

    return $value;
  }
}
