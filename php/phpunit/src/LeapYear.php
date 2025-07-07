<?php

namespace Diginamic\Phpunit;

use Exception;

class LeapYear
{
  static function isLeapYear($year)
  {
    if (!is_integer($year)) return new Exception('Year must be an integer');

    if ($year % 4 === 0) {
      if ($year % 100 === 0) {
        return $year % 400 === 0;
      }
      return true;
    }
    return false;
  }
}
