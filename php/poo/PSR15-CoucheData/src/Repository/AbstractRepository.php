<?php

/**
 * Définit les attributs communs à tous les repositories : $db, $table, $entityClass
 * Définit également toutes les méthodes partagées par les classes qui hériteront de AbstractRepository : findAll, findById, save, delete
 * On remarque que toutes ces méthodes sont "codées" sauf save ce qui veut dire que les classes filles seront obligées de l'implémenter (la coder)
 */

namespace Diginamic\Framework\Repository;

use Diginamic\Framework\Database\Database;
use PDO;

abstract class AbstractRepository implements RepositoryInterface
{
  // une instance de PDO, on se doute que qu'elle proviendra de la classe Database
  protected PDO $db;

  // le nom de la table concernée
  protected string $table;

  // Correspond au modèle (cf src/Model)
  protected string $entityClass;

  public function __construct()
  {
    // Appel de getInstance pour récupérer le singleton issue de Database
    $this->db = Database::getInstance();
  }

  public function findAll(): array
  {
    $stmt = $this->db->query("SELECT * FROM {$this->table}");

    // La méthode fetchAll fait automatiquement le lien entre les données de la base de données et l'entité "objet" $this->entityClass
    // Cela veut dire que les instances du modèle (User par exemple) seront bien instanciées.
    // Attention cependant, PDO n'est pas un vrai ORM et il n'est pas capable de transformer, par exemple, 
    // le champ created_at en attribut createdAt
    // Il va falloir utiliser la fonction magique __set pour pallier ce manque
    return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
  }

  public function findById(int $id): ?object
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $this->entityClass);

    $entity = $stmt->fetch();
    return $entity ?: null;
  }

  abstract public function save(object $entity): bool;

  public function delete(int $id): bool
  {
    $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
    return $stmt->execute(['id' => $id]);
  }
}
