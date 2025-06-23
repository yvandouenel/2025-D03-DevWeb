<?php

use Diginamic\Phpunit\FizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{

  function testFizzBuzz()
  {
    // Création d'une instance de FizzBuzz
    $fizzBuzz = new FizzBuzz();

    // Assertions simples
    $this->assertSame(1, $fizzBuzz->fizzBuzz(1));
    $this->assertSame(2, $fizzBuzz->fizzBuzz(2));
    $this->assertSame(4, $fizzBuzz->fizzBuzz(4));

    // Assertions Fizz
    $this->assertSame("Fizz", $fizzBuzz->fizzBuzz(3));
    $this->assertSame("Fizz", $fizzBuzz->fizzBuzz(6));
    $this->assertSame("Fizz", $fizzBuzz->fizzBuzz(9));

    // Assertions Buzz
    $this->assertSame("Buzz", $fizzBuzz->fizzBuzz(5));
    $this->assertSame("Buzz", $fizzBuzz->fizzBuzz(10));

    // Assertions Fizz Buzz
    $this->assertSame("Fizz Buzz", $fizzBuzz->fizzBuzz(15));
    $this->assertSame("Fizz Buzz", $fizzBuzz->fizzBuzz(30));

    // Assertion Erreur, doit renvoyer une instance d'erreur
    $this->assertInstanceOf(Exception::class, $fizzBuzz->fizzBuzz(-5));
    $this->assertInstanceOf(Exception::class, $fizzBuzz->fizzBuzz(1.5));
  }
}
