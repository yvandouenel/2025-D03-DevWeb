<?php

class A
{
  const NOMBRE = 1;
  private const CHAINE = "mot";

  public function getChaine()
  {
    return self::CHAINE;
  }
}

echo A::NOMBRE . PHP_EOL;

$objet = new A();
echo $objet->getChaine() . PHP_EOL;
