<?php
class A
{
  public function double()
  {
    echo 'Je suis dans la fonction double de la classe A' . PHP_EOL;
  }
}



class B extends A
{
  public function double($nb = false)
  {
    echo 'Je suis dans la fonction double de B' . PHP_EOL;
  }
}

$objet = new B();
$objet->double();
$objet->double(2);
