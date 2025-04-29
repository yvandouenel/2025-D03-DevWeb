<?php

class MyClass
{
  // Attributs qui ont tous une valeur par défaut
  public $a = "Chine";
  protected $b = "Australie";
  private $c = "Espagne";
  /**
   * L'accesseur générique est une méthode qui va comparer les noms des attributs (les clés) avec l'argument passé en paramètre
   * Dans le cas où l'argument correspond bien à un nom d'attribut, la méthode renvoie la valeur correspondante
   * Sinon, la méthode renvoie la chaîne de caractères "Cette propriété n'existe pas"
   * @param [type] $prop
   * @return void
   */
  public function getProp($prop)
  {
    // parcours de l'instance en cours (dans mon exemple $this qui est une référence à $objet)
    foreach ($this as $key => $value) {
      if ($key == $prop) {
        return $value;
      }
    }
    return "Cette propriété n'existe pas";
  }
}

$objet = new MyClass();



echo $objet->getProp('a') . PHP_EOL;
echo $objet->getProp('b') . PHP_EOL;
echo $objet->getProp('c') . PHP_EOL;
echo $objet->getProp('d') . PHP_EOL;
