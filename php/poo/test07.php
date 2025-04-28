<?php
class A
{
  public static $multiplicateur = 2;
  public $nombre;

  public function __construct($n)
  {
    $this->nombre = $n;
  }
  public function multiplier($nombre)
  {
    echo "$nombre x " . self::$multiplicateur . "=" . ($nombre * self::$multiplicateur) . " - ";
  }
}


for ($i = 2; $i < 10; $i++) {
  // Réassignation de l'attribut de classe $multiplicateur
  A::$multiplicateur = $i;
  for ($j = 2; $j < 10; $j++) {
    // Intanciation de A et on stocke le résultat dans $objet à l'index $j
    $objet[$j] = new A($j);
    $objet[$j]->multiplier($j);
  }
  echo PHP_EOL;
}
