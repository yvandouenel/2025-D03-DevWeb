<?php
abstract class A
{
  protected function __construct()
  {
    echo 'le constructeur de la classe abstraite A';
  }
}

class B extends A
{
  public function __construct()
  {
    echo "Je suis dans le constructeur de la classe B et je vais appeler ";
    parent::__construct();
  }
}

$objet = new B();
