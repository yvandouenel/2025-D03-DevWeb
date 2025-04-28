<?php

class A
{
  public $a;
  protected $b;
  private $c;
  /**
   * Get the value of c
   */
  public function getC()
  {
    return $this->c;
  }
  /**
   * Set the value of c
   * @return  self
   */

  public function setC($c)
  {
    $this->c = $c;
    return $this;
  }
}

class B extends A {}

$objet = new B();
$objet->setC(10);
var_dump($objet);
