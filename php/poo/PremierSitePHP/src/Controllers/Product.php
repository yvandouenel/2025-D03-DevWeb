<?php
// Création de l'espace de nom
namespace Diginamic\Controllers;

class Product
{
  public function __construct(private string $name) {}

  public function getName()
  {
    return $this->name;
  }
}
