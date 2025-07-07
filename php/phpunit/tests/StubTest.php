<?php

use Diginamic\Phpunit\SomeClass;
use PHPUnit\Framework\TestCase;



class StubTest extends TestCase
{
  public function testStub()
  {
    // Créer un bouchon pour la classe SomeClass.
    $stub = $this->createMock(SomeClass::class);

    // Configurer le bouchon.
    $stub->method('doSomething')
      ->willReturn('foo');

    // Appeler $stub->doSomething() va maintenant retourner
    // 'foo'.
    $this->assertSame('foo', $stub->doSomething());
  }

  public function testIsInstanceOf(): void
  {
    $someClass = new SomeClass();
    $this->assertInstanceOf(SomeClass::class, $someClass);
  }
}
