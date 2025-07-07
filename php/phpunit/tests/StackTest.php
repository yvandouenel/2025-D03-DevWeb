<?php

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
  public function testEmpty()
  {
    $stack = [];
    $this->assertEmpty($stack);
    return $stack;
  }

  /**
   * Cette ligne est une ligne de commentaire classique mais attention, lorsque vous voyez une ligne de commentaire qui commence par @xxx, alors nous avons affaire à un décorateur, c'est à dire que php va exécuter du code qui dépend de la méthode qui se trouve juste après le commentaire (ici testPush)
   * @depends testEmpty
   */
  public function testPush(array $stack)
  {
    $this->assertEmpty($stack);
    array_push($stack, "Foo");
    return $stack;
  }
  /**
   * Undocumented function
   *
   * @depends testPush
   */
  public function testPop(array $stack)
  {
    // Teste que la dernière valeur du tableau est "Foo"
    $this->assertSame("Foo", $stack[count($stack) - 1]);

    // Vérifie que la valeur supprimée avec pop est "Foo"
    $this->assertSame("Foo", array_pop($stack));

    // Vérifie que $stack est vide
    $this->assertEmpty($stack);
  }

  public function testPushAndPop()
  {
    $arrayTest = [];

    // Première assertion : la taille du tableau $arrayTest est égale à 0
    $this->assertSame(0, count($arrayTest));

    // Ajout d'une valeur au tableau $arrayTest
    array_push($arrayTest, "Toto");
    array_push($arrayTest, "Titi");
    // Deuxième assertion : la taille du tableau $arrayTest est égale à 1
    $this->assertSame(2, count($arrayTest));

    // Troisième assertion : la dernière valeur ajoutée est "Toto"
    $this->assertSame("Titi", $arrayTest[count($arrayTest) - 1]);
  }
}
