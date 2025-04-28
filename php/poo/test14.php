<?php

declare(strict_types=1);

interface Banque
{
  public function payer(float $montant): void;
}

class UneBanque implements Banque
{
  public function payer(float $montant): void
  {
    echo "Je paye $montant avec UneBanque" . PHP_EOL;
  }
}

class AutreBanque implements Banque
{
  public function payer(float $montant): void
  {
    echo "Je paye $montant avec AutreBanque" . PHP_EOL;
  }
}

class Payer
{
  // Attribut de classe de type Banque (interface)
  private static Banque $banque;

  public static function setPayer(string $type, float $montant): void
  {
    // si la classe de nom $type existe
    if (class_exists($type)) {
      // Assignation d'une instance à l'attribut de classe $banque
      self::$banque = new $type();
      self::$banque->payer($montant);
    } else {
      echo 'Ce type de paiement n\'existe pas' . PHP_EOL;
    }
  }
}

Payer::setPayer("UneBanque", 100);

Payer::setPayer("A", 100);

Payer::setPayer("AutreBanque", 200);
