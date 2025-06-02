<?php

namespace Diginamic\Framework\Services;

class ServiceLocator
{
  // Création de l'attribut static service qui est par défaut un tableau vide
  private static $services = [];

  /**
   * Ajout d'un clé et d'une valeur correspondante à l'attribut $services
   *
   * @param String $name
   * @param Function ou Object $service
   * @return void
   */
  public static function set($name, $service)
  {
    self::$services[$name] = $service;
  }
  /**
   * Récupère la valeur correspondant à la clé $name du tableau static $services
   * Lance une erreur si la clé n'existe pas
   * @param [type] $name
   * @return object
   */
  public static function get($name)
  {
    if (isset(self::$services[$name])) {
      return self::$services[$name];
    }
    return new \stdClass();
  }
}
