<?php

namespace Diginamic\Framework\Views;

use Dom\HTMLElement;

class View
{

  // méthode de classe qui renvoie la base du html
  public static function baseTemplate($title, $insideBody): string
  {
    // Syntaxe Herédoc
    $html = <<<HTML
      <!DOCTYPE html>
      <html lang="fr">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$title</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
      </head>
      <body>
        <div class="container">
            $insideBody
        </div>
      </body>
      </html>
    HTML;
    return $html;
  }
  public static function header(array $links): string
  {
    // Générer le menu à partir d'un tableau qui contient les intitulés des liens, le chemin et active
    $lis = "";
    foreach ($links as $link) {

      $lis .= "<li><a href=\"$link->path\" class=\"$link->active\">$link->title</a></li>";
    }


    // Syntaxe Herédoc
    $html = <<<HTML
      <header>
        <nav>
          <ul>
            <li><a href="/" class="">Accueil</a></li>
            <li><a href="/users">Administration</a></li>
            
          </ul>
        </nav>
      </header>
    HTML;
    return $html;
  }
}
