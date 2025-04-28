<?php
class A
{
  public function A()
  {
    print ('Je suis la fonction A') . PHP_EOL;
  }

  protected function B()
  {
    print ('Je suis la fonction B') . PHP_EOL;
  }
}

class B extends A
{
  public function C()
  {
    $this->A();
    $this->B();
  }
}

$objet = new B();
$objet->C();
