<?php

namespace Diginamic\UserManagement\Repository;

use Diginamic\UserManagement\Config\Database;
use PDO;

abstract class AbstractRepository implements RepositoryInterface {
    protected PDO $pdo;
    protected string $table;
    protected string $entityClass;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
    }

    public function findById(int $id): ?object {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->entityClass);
        $entity = $stmt->fetch();
        
        return $entity ?: null;
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    abstract public function save(object $entity): bool;
}