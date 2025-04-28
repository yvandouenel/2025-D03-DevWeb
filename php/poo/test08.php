<?php
class A
{

  protected static  $test = "class a" . PHP_EOL;

  public function staticTest()
  {
    // static::$test fait référence à l'attribut $test qui correspond à la classe de l'instance appelante
    echo static::$test; // Results class b
    echo self::$test; // Results class a
  }
}

class B extends A
{

  protected static $test = "class b"  . PHP_EOL;
}

$obj = new B();
$obj->staticTest();

$obj2 = new A();
$obj2->staticTest();
