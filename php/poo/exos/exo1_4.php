<?php

class Playlist
{
  private array $chansons = [];


  public function ajouter($titre)
  {
    $this->chansons[] = $titre;
    return $this;
  }

  public function supprimer($titre)
  {
    unset($this->chansons[array_search($titre, $this->chansons, true)]);
    return $this;
  }

  public function getListe()
  {
    return implode(" - ", $this->chansons) . PHP_EOL;
  }

  public function vider()
  {
    $this->chansons = [];
    return $this;
  }
}

$liste = new Playlist();
echo $liste->ajouter("Bleed")->getListe();
echo $liste->ajouter("Californication")->getListe();
echo $liste->supprimer("Californication")->getListe();
