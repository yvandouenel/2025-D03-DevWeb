<?php
// Création de l'espace de nom
namespace Diginamic\Models;

use Diginamic\Interfaces\ProductInterface;

class Product implements ProductInterface
{
  public function __construct(private string $id, private string $name, private float $price, private string $description, private bool $available) {}

  public function getID()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getPrice()
  {
    return $this->price;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function isAvailable()
  {
    if ($this->available == true) {
      return 'est disponible';
    } else {
      return 'est indisponible';
    }
  }
}
