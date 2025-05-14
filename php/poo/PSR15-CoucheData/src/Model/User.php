<?php

namespace Diginamic\Framework\Model;

class User
{
  public ?int $id = null;
  public string $login;
  public string $password; // En production, utiliser un hash
  public string $email;
  public ?string $createdAt = null;

  public function hydrate(array $data): void
  {
    foreach ($data as $key => $value) {
      $camelCaseKey = lcfirst(str_replace('-', '', ucwords($key, '-')));
      var_dump($camelCaseKey);

      if (property_exists($this, $camelCaseKey)) {
        $this->$camelCaseKey = $value;
      }
    }
  }
  /* 
  private function convertToCamelCase(string $str): string
  {
    return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $str))));
  } */
}
