 <?php
  /**
   * Le principe du routage est de faire le lien entre le chemin d'un requête (ci-dessous : velomobiles)
      https://velomobile.fr/velomobiles/
      et un routeur
   */

  $requestPath = "velomobiles";

  $routePath = "velomobiles/{13674}/patch";

  // par défaut en php, les fonctions créent leur propre scope
  // cependant, le fonctionnement n'est pas le même qu'en js. 
  // On a pas accès au scope globa à l'intérieur de la fonction.
  // Pour palier ce fonctionnement, on peut utiliser le mot clé use
  $getRegexPattern = function () use ($routePath): string {
    $pattern = $routePath;

    // Remplacer les paramètres {param} par des groupes de capture nommés
    $pattern = preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', function ($matches) {
      $paramName = $matches[1];
      // Utiliser le pattern spécifique s'il existe, sinon utiliser un pattern par défaut
      $regex = $this->paramPatterns[$paramName] ?? '[^/]+';
      return '(?P<' . $paramName . '>' . $regex . ')';
    }, $pattern);

    return '@^' . $pattern . '$@D';
  };

  $matches = function (string $requestPath) use ($routePath): bool {
    // Si la route ne contient pas de paramètres, comparaison directe
    echo strpos($requestPath, '{');
    if (strpos($routePath, '{') === false) {
      return $routePath === $requestPath;
    }
    return false;
  };

  if ($matches($requestPath)) {
    echo "les deux routes matchent";
  } else {
    echo "les deux routes ne matchent pas";
  };
