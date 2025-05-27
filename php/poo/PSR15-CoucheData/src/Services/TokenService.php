<?php

namespace Diginamic\Framework\Services;


class TokenService
{

  /**
   * Crée un token et l'assigne à la session en utilisant la clé token
   *
   * @return String
   */
  public function createToken()
  {
    if (!isset($_SESSION)) {
      // Utilisation d'un cookie httponly afin d'empêcher le javascript d'y accéder
      ini_set('session.cookie_httponly', 1);
      // Démarrer la session dans laquelle on peut stocker des infos concernant un même client (navigateur)
      session_start();
    }
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return  $_SESSION['token'];
  }
}
