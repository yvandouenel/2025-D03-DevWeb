<?php

namespace Diginamic\Framework\Controller;

abstract class Controller
{
  protected array $routes;

  protected function routesToLinks($activePath)
  {
    $links = [];
    foreach ($this->routes as $route) {
      if ($route["titleMenu"]) {
        $links[] = [
          "title" => $route["titleMenu"],
          "path" => $route['path'],
          "active" => ($route['path'] == $activePath) ? " active" : "",
        ];
      }
    }
    return $links;
  }
}
