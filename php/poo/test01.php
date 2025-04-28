<?php

class Vehicule
{
  // attributs
  public string $marque;
  public string $couleur;
  public string $modele;
  protected bool $moteurTourne;

  public function __construct($brand, $color, $model)
  {
    $this->marque = $brand;
    $this->couleur = $color;
    $this->modele = $model;
    $this->moteurTourne = false;
  }
  /**
   * Affiche la marque et le modèle du véhicule suivit de "démarre"
   *
   * @return void
   */
  public function demarrer()
  {
    $this->moteurTourne = true;
    echo $this->marque . " " . $this->modele . " démarre" . PHP_EOL;
  }
  /**
   * Affiche la marque et le modèle du véhicule suivit de "démarre"
   *
   * @return void
   */
  public function arreter()
  {
    $this->moteurTourne = true;
    echo $this->marque . " " . $this->modele . " s'arrête" . PHP_EOL;
  }

  public function afficheDetails()
  {
    // opérateur teraire : permet d'assigner une valeur en fonction d'un booléen.
    $moteurTourne = $this->moteurTourne ? " tourne." : " ne tourne pas.";
    echo "Ce véhicule $this->modele  est de la marque  $this->marque il est de couleur $this->couleur  et le moteur $moteurTourne " . PHP_EOL;
  }
}

// Classe Voiture qui hérite de Vehicule
class Voiture extends Vehicule
{
  // Avec l'utilisation du mot clé static, $volant devient un attribut de classe (et non pas d'instance comme les autres)
  public static bool $volant = true;
  public int $portes;
  public function __construct($brand, $color, $model, $doors)
  {
    parent::__construct($brand, $color, $model);
    $this->portes = $doors;
  }
  /**
   * Polymorphisme
   *
   * @return void
   */
  public function afficheDetails()
  {
    // opérateur teraire : permet d'assigner une valeur en fonction d'un booléen.
    $moteurTourne = $this->moteurTourne ? "tourne." : "ne tourne pas";
    echo "Cette voiture $this->modele, de la marque $this->marque et de couleur $this->couleur et dont le moteur $moteurTourne a $this->portes portes." . PHP_EOL;
    echo "Bien entendu cette voiture a pour valeur de volant : " . self::$volant . PHP_EOL;
  }
}

// Création de l'instance "peugeot" "blanc" "106"
$peugeot106 = new Vehicule("Peugeot", "Blanc", "106");
$peugeot106->afficheDetails();


// Appel de la méthode depuis une instance
$peugeot106->demarrer();
$peugeot106->afficheDetails();

// Création d'une seconde instance
$merco = new Vehicule("Mercedes", "Grise", "Class C AMG");
$merco->demarrer();
$merco->afficheDetails();

// Création d'une voiture
$renault5 = new Voiture("Renault", "rouge", "R5", 5);
$renault5->afficheDetails();

// Je veux afficher $volant sans passer par une instance. Comment faire ?
echo Voiture::$volant;
