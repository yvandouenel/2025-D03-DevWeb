<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class JsonTest extends TestCase
{
  public function testFailure(): void
  {
    // Créer un tableau associatif et le transtyper en json
    $people = [
      ["name" => "Dylan", "firstname" => "Bob"],
      ["name" => "Marley", "firstname" => "Bob"],
    ];
    $jsonPeople = json_encode($people);
    $this->assertJson($jsonPeople);
  }
}
