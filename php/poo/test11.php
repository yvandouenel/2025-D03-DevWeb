<?php
class A
{
  const NOMBRE = 1;
}


class B extends A
{
  const NOMBRE = 2;
}

echo A::NOMBRE . PHP_EOL;
echo B::NOMBRE;
