<?php

class PorteMonnaie
{
  public function __construct(private float $solde, private string $devise) {}

  public function deposer(float $montant)
  {
    $this->solde += $montant;
    return $this;
  }
  public function retirer(float $montant)
  {
    if ($montant <= $this->solde) {
      $this->solde -= $montant;
    }
    return $this;
  }

  public function convert($montant, string $deviseOrigine, string $deviseCible)
  {
    if ($deviseOrigine == $deviseCible) {
      return $montant;
    }
    return $montant;
  }
}
