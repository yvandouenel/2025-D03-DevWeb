<?php

/**
 * Interface Vehicle
 * 
 * Interface qui définit les méthodes que tous les véhicules doivent implémenter
 */
interface Vehicle
{
  /**
   * Démarre le véhicule
   * 
   * @return bool Retourne true si le démarrage est réussi, false sinon
   */
  public function start();

  /**
   * Arrête le véhicule
   * 
   * @return bool Retourne true si l'arrêt est réussi, false sinon
   */
  public function stop();

  /**
   * Accélère le véhicule
   * 
   * @param int $level Niveau d'accélération
   * @return void
   */
  public function accelerate($level);

  /**
   * Freine le véhicule
   * 
   * @param int $level Niveau de freinage
   * @return void
   */
  public function brake($level);

  /**
   * Tourne le véhicule
   * 
   * @param string $direction Direction (left, right)
   * @param int $angle Angle de rotation en degrés
   * @return void
   */
  public function turn($direction, $angle);

  /**
   * Récupère la vitesse actuelle du véhicule
   * 
   * @return float Vitesse actuelle en km/h
   */
  public function getCurrentSpeed();

  /**
   * Récupère le niveau de carburant/charge du véhicule
   * 
   * @return float Pourcentage de carburant/charge restant
   */
  public function getFuelLevel();

  /**
   * Obtient le type de véhicule
   * 
   * @return string Type de véhicule (voiture, moto, vélo, etc.)
   */
  public function getType();
}

/**
 * Exemple d'implémentation d'une classe qui utilise cette interface
 */
class Car implements Vehicle
{
  private $speed = 0;
  private $fuelLevel = 100;
  private $engineStarted = false;

  public function start()
  {
    if ($this->fuelLevel > 0) {
      $this->engineStarted = true;
      return true;
    }
    return false;
  }

  public function stop()
  {
    $this->engineStarted = false;
    $this->speed = 0;
    return true;
  }

  public function accelerate($level)
  {
    if ($this->engineStarted && $this->fuelLevel > 0) {
      $this->speed += $level;
      $this->fuelLevel -= $level * 0.1; // Consommation de carburant
    }
  }

  public function brake($level)
  {
    $this->speed = max(0, $this->speed - $level);
  }

  public function turn($direction, $angle)
  {
    // Logique pour tourner la voiture
    // Pour cet exemple, on simule simplement l'action
    return ($direction === 'left' || $direction === 'right');
  }

  public function getCurrentSpeed()
  {
    return $this->speed;
  }

  public function getFuelLevel()
  {
    return $this->fuelLevel;
  }

  public function getType()
  {
    return 'Car';
  }
}

// Exemple d'utilisation
$car = new Car();
$car->start();
$car->accelerate(20);
echo "Vitesse actuelle: " . $car->getCurrentSpeed() . " km/h\n";
echo "Niveau de carburant: " . $car->getFuelLevel() . "%\n";
$car->brake(10);
echo "Nouvelle vitesse après freinage: " . $car->getCurrentSpeed() . " km/h\n";
$car->stop();
echo "Moteur arrêté, vitesse: " . $car->getCurrentSpeed() . " km/h\n";
