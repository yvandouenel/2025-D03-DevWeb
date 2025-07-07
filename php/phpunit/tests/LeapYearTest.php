<?php

use Diginamic\Phpunit\LeapYear;
use PHPUnit\Framework\TestCase;


class LeapYearTest extends TestCase
{
  public function testIsLeapYear()
  {

    // Retour d'une Exception
    $this->assertInstanceOf(Exception::class, LeapYear::isLeapYear(1.5));
    $this->assertInstanceOf(Exception::class, LeapYear::isLeapYear('saucisse'));

    // Cas général
    $this->assertFalse(LeapYear::isLeapYear(2025));

    // Année Bissextile
    $this->assertTrue(LeapYear::isLeapYear(2020));
    $this->assertTrue(LeapYear::isLeapYear(2024));
    $this->assertTrue(LeapYear::isLeapYear(2028));

    // Année non Bissextile car multiple de 100 mais pas de 400
    $this->assertFalse(LeapYear::isLeapYear(2200));
    $this->assertFalse(LeapYear::isLeapYear(1900));

    // Année Bissextile car multiple de 400
    $this->assertTrue(LeapYear::isLeapYear(2400));
  }
}
