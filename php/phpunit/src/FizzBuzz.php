<?php

namespace Diginamic\Phpunit;

use Exception;

class FizzBuzz
{
  public function fizzBuzz($num)
  {
    // Teste si l'argument passé est bien un entier sinon doit renvoyer une erreur
    if (!is_int($num)) return new Exception("Valeur interdite, l'argument doit être un entier.");
    // Teste si l'argument passé est bien un entier positif sinon doit renvoyer une erreur
    else if ($num < 1) return new Exception("Valeur interdite, Valeur interdite, l'argument doit être un entier positif");
    else if ($num % 3 === 0 && $num % 5 === 0) return "Fizz Buzz";
    else if ($num % 3 === 0) return "Fizz";
    else if ($num % 5 === 0) return "Buzz";
    return $num;
  }
}
