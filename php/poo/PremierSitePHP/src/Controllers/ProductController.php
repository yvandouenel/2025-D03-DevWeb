<?php

namespace Diginamic\Controllers;

class ProductController
{
  // attributs
  private array $products = [];

  // méthode pour récupérer tous les produits
  public function getAllProducts()
  {
    return $this->products;
  }
}
