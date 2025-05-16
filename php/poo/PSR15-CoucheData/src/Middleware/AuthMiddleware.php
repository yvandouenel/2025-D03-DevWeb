<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Diginamic\Framework\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class AuthMiddleware implements MiddlewareInterface
{
  /**
   * @var array Routes qui nécessitent une authentification
   */
  private array $protectedRoutes;
  public static array $globaProtectedRoutes = [];

  /**
   * @param array $protectedRoutes Liste des routes protégées (ex: ['/admin', '/profile'])
   */
  public function __construct(array $protectedRoutes = [])
  {
    $this->protectedRoutes = $protectedRoutes;
    self::$globaProtectedRoutes = array_merge(self::$globaProtectedRoutes, $protectedRoutes);
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
    $path = $request->getUri()->getPath();

    // Vérifiez si la route actuelle est protégée
    foreach ($this->protectedRoutes as $protectedRoute) {
      if (strpos($path, $protectedRoute) === 0) {
        // Ici, mettre la logique d'authentification
        // Par exemple, vérifier si l'utilisateur est connecté via une session

        if (!$this->isAuthenticated($request)) {
          // Redirection vers la page de connexion ou message d'erreur
          return new Response(
            401,
            ['Content-Type' => 'text/html'],
            '<h1>401 - Non autorisé</h1><p>Vous devez être connecté pour accéder à cette page.</p>'
          );
        }

        break;
      }
    }

    // Si tout va bien, passez au middleware/contrôleur suivant
    return $next($request);
  }

  /**
   * Vérifie si l'utilisateur est authentifié
   * 
   * @param ServerRequestInterface $request
   * @return bool
   */
  private function isAuthenticated(ServerRequestInterface $request): bool
  {
    error_log("DANS isAuthenticated DE AUTHMIDDLEWARE");

    // Si l'utilisateur est déjà authentifié via la session
    if (isset($_SESSION['user_authenticated']) && $_SESSION['user_authenticated'] === true) {
      error_log("USER authenticated with session");
      return true;
    }

    // Si la requête est une soumission de formulaire de connexion
    if ($request->getMethod() === 'POST' && $request->getUri()->getPath() === '/login-post') {
      $formData = $request->getParsedBody();
      $login = $formData['login'] ?? '';
      $password = $formData['password'] ?? '';

      // Utiliser le repository pour authentifier
      $userRepository = new UserRepository();
      $user = $userRepository->authenticate($login, $password);

      if ($user) {
        // Authentification réussie - stocker dans la session
        $_SESSION['user_authenticated'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_login'] = $user->login;
        return true;
      }
    }

    return false;
  }

  /**
   * Exemple de méthode pour valider un token JWT
   * 
   * @param string $token
   * @return bool
   */
  private function validateToken(string $token): bool
  {
    // Logique de validation de token
    // À implémenter selon votre besoin (JWT, OAuth, etc.)
    return false;
  }
}
