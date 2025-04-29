<?php

class Produit
{
  public string $nom;
  protected float $prix;
  private string $reference;

  public function __construct()
  {
    $this->nom = "passoire";
    $this->prix = 12;
    $this->reference = "dodleoOO";
  }

  public function get($nomPropriete)
  {
    foreach ($this as $key => $value) {
      if ($key == $nomPropriete) {
        return $value;
      }
    }
    return "Cette propriété n'existe pas";
  }

  public function set($nomPropriete, $valeur)
  {
    foreach ($this as $key => $value) {
      if ($key == $nomPropriete) {
        $this->$key = $valeur;
        return $this;
      }
    }
    return $this;
  }
}

$produit1 = new Produit("bougie", "1.99", "ref:1678");

echo $produit1->set("nom", "red bull")->get("nom") . PHP_EOL;
echo $produit1->set("prix", "2.78")->get("prix") . PHP_EOL;
echo $produit1->set("reference", "GHT5")->get("reference") . PHP_EOL;
echo $produit1->set("quantité", "12")->get("quantité") . PHP_EOL;
