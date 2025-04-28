<?php

class A
{
  // Attribut privé
  private $name;
  private function __construct($name = null)
  {
    // Assigne une valeur à l'attribut privé $name lors de l'instanciation (avec new)
    $this->name = $name;
  }
  public static function objetFromName(string $name)
  {
    $objet = new A($name);
    return $objet;
  }
  public static function objetFromArray(array $array)
  {
    // Teste si la clé name du tableau $array existe, alors je me sers de la valeur pour créer une nouvelle instance de A
    if (array_key_exists('name', $array)) {
      $objet = new A($array['name']);
      return $objet;
    }
    $objet = new static();
    return $objet;
  }
}
$test = A::objetFromName('tartempion');
var_dump($test);

$test2 = A::objetFromArray(['name' => 'duchemol']);
var_dump($test2);

$test3 = A::objetFromArray(['qsdf' => 'duchemol']);
var_dump($test3);
