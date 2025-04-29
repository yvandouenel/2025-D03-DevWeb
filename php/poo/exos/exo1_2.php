<?php

class CarteBancaire
{
  // 3 attributs dont un privé
  private string $code;
  public int $numero;
  public string $dateExpiration;

  public function __construct($code, $numero, $dateExpiration)
  {
    $this->code = $code;
    $this->numero = $numero;
    $this->dateExpiration = $dateExpiration;
  }

  public function getCode()
  {
    return $this->code;
  }
  public function setCode(string $newCode)
  {
    // Il faut vérifier que le nouveau code est bien composé de 4 chiffres.
    // Transtyper en chaine de caractères puis utiliser un expression regulière de la forme [0-9]4
    // Convertir l'entier en chaîne pour appliquer l'expression régulière
    $codeString = (string)$newCode;

    echo $codeString . PHP_EOL;
    // Vérifier que le code est composé exactement de 4 chiffres
    if (preg_match('/^\d{4}$/', $codeString)) {
      $this->code = $newCode;
    } else {
      echo "ne passe pas la regexp" . PHP_EOL;
    }
  }
}

$cb1 = new CarteBancaire(1234, 12349874354687, "12/01/2026");

// Quand un attribut est privé, je suis obligé de passer par un setter (qui lui est publique)
$cb1->setCode("15889");

echo $cb1->getCode();
