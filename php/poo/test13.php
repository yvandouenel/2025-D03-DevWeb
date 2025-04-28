<?php

// L'interface Engine définit le contrat 
interface EngineInterface
{
  public function start(): void;
  public function stop(): void;
}
// Une implémentation concrète de moteur V8 
class V8Engine implements EngineInterface
{
  public function __construct(private string $name) {}
  public function start(): void
  {
    echo "Je démarre avec le moteur " . $this->name;
  }
  public function stop(): void
  {
    echo "J'arrête le moteur " . $this->name;
  }
}
// Une autre implémentation  
class ElectricEngine implements EngineInterface
{
  public function __construct(private string $name) {}
  public function start(): void
  {
    echo "Je démarre silencieusement avec le moteur électrique " . $this->name;
  }
  public function stop(): void
  {
    echo "J'arrête le moteur électrique " . $this->name;
  }
}
// La classe Car reçoit maintenant n'importe quel type de moteur qui implémente EngineInterface 
class Car
{
  private EngineInterface $engine;
  public function __construct(EngineInterface $engine)
  {
    $this->engine = $engine;
  }
  public function start(): void
  {
    $this->engine->start();
  }
  public function stop(): void
  {
    $this->engine->stop();
  }
}
