<?php

class Smartphone
{

  // Déclaration des attributs
  public string $marque;
  public string $modele;
  public string $systemeExploitation;
  public string $tailleEcran;

  public function __construct($brand, $model, $exploitationSystem, $screenSize)
  {
    $this->marque = $brand;
    $this->modele = $model;
    $this->systemeExploitation = $exploitationSystem;
    $this->tailleEcran = $screenSize;
  }
  public function allumer()
  {
    echo "Le smartphone s'allume" . PHP_EOL;
  }
  public function charger()
  {
    echo "Le smartphone est en charge" . PHP_EOL;
  }
  // Ré-écriture de la méthode toString (polymorphisme)
  public function __toString()
  {
    return  "Info smartphone : " . PHP_EOL .
      "   Marque : " . $this->marque . PHP_EOL .
      "   Modèle : " . $this->modele . PHP_EOL .
      "   Système : " . $this->systemeExploitation . PHP_EOL .
      "   Taille écran : " . $this->tailleEcran . PHP_EOL;
  }
}
$smartphone1 = new Smartphone("Apple", "Iphone 13", "IOS", "6.5");
$smartphone2 = new Smartphone("Samsung", "S21", "Android", "6.2");

echo $smartphone1;

$smartphone1->allumer();
$smartphone1->charger();
echo $smartphone2;
