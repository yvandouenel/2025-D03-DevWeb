<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Diginamic\Framework\Repository\UserRepository;
use Diginamic\Framework\Services\ServiceLocator;
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
    // S'assurer qu'une session est active
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    // Récupération de l'instance de twig
    $twig = ServiceLocator::get("twig");

    $navService = ServiceLocator::get("navService");
    // Gestion du temps de la session. Si la durée est expirée, je renvoie vers le login
    if (time() - $_SESSION['created_at'] > 1440) {
      session_destroy();
    }
    // Si la requête est une soumission de formulaire utilisant la méthode post alors il faut un token
    if ($request->getMethod() === 'POST') {
      $formData = $request->getParsedBody();
      if ($_SESSION["token"] !==  $formData['token']) {
        $html = $twig->render('error/index.twig', [
          'title' => "Problème de sécurité",
          'links' => $navService->routesToLinks('/users'),
        ]);
        return new Response(
          400,
          ['Content-Type' => 'text/html'],
          $html
        );
      }
    }
    // Vérifiez si la route actuelle est protégée
    foreach ($this->protectedRoutes as $protectedRoute) {
      error_log("chemin : " . $path);
      error_log("protectedRoute : " . $protectedRoute);
      if ($path === $protectedRoute) {
        error_log("protectedRoute et path correspondent");

        // Si $_SESSION['failed_login_attempt'] > 3 alors je ne teste pas si l'utilisateur est authentifié, je renvoie directement un message
        // indiquant qu'il est black listé
        if (isset($_SESSION['failed_login_attempt']) && $_SESSION['failed_login_attempt'] > 3) {
          // Récupération de l'instance de NavigationService




          $html = $twig->render('error/index.twig', [
            'title' => "Tu es blacklisté mon vieux",
            'links' => $navService->routesToLinks('/users'),
          ]);
          return new Response(
            400,
            ['Content-Type' => 'text/html'],
            $html
          );
        }

        // Ici, mettre la logique d'authentification
        // Par exemple, vérifier si l'utilisateur est connecté via une session

        if (!$this->isAuthenticated($request)) {
          if (!isset($_SESSION['failed_login_attempt'])) {
            $_SESSION['failed_login_attempt'] = 1;
          } else {
            $_SESSION['failed_login_attempt'] = $_SESSION['failed_login_attempt'] + 1;
            //Si c'est supérieur à 3, alors je lui renvoie immédiatement une réponse pour lui dire qu'il est out pour un moment

          }
          // Redirection vers la page de connexion ou message d'erreur
          return new Response(
            302,
            ['Location' => '/login'],
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
        error_log("Authentification réussie");
        $_SESSION['user_authenticated'] = true;
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_login'] = $user->login;
        return true;
      } else {
        error_log("Echec de l'authentification");
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
