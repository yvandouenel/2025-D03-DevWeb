<?php

namespace Diginamic\Controllers;

use Diginamic\Models\Product;

class ProductController
{
  // attributs
  private array $products = [];

  // Constructeur
  public function __construct()
  {
    // Ajout d'un produit au tableau products
    $this->products[] = new Product("1", "Poupée Barbie", 27, "Magnifique poupée barbie fleur", true);
    $this->products[] = new Product("2", "Canapé pliable", 620, "Canapé convertible en cuir", true);
    $this->products[] = new Product("3", "Trotinette volante", 666875588520, "La meilleure sur le marché", true);
  }

  // méthode pour récupérer tous les produits
  public function getAllProducts()
  {
    return $this->products;
  }
  /**
   * Permet de récupérer un produit
   *
   * @param [type] $id
   * @return Product | null
   */
  public function getOneProduct($id)
  {
    foreach ($this->products as $product) {
      if ($product->getId() == $id) {
        return $product;
      }
    }
    return null;
  }
}
