<?php

namespace Diginamic\UserManagement\Repository;

use Diginamic\UserManagement\Model\User;
use PDO;

class UserRepository extends AbstractRepository
{
    protected string $table = 'users';
    protected string $entityClass = User::class;

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->entityClass);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function authenticate(string $username, string $password): ?User
    {
        $user = $this->findByUsername($username);

        // En production, utilisez password_verify()
        if ($user && $user->getPassword() === $password) {
            return $user;
        }

        return null;
    }

    public function save(object $entity): bool
    {
        if (!$entity instanceof User) {
            throw new \InvalidArgumentException("L'entité doit être une instance de User");
        }

        if ($entity->getId()) {
            // Mise à jour
            $stmt = $this->pdo->prepare("
                UPDATE {$this->table} 
                SET username = :username, email = :email, password = :password 
                WHERE id = :id
            ");

            return $stmt->execute([
                'id' => $entity->getId(),
                'username' => $entity->getUsername(),
                'email' => $entity->getEmail(),
                'password' => $entity->getPassword()
            ]);
        } else {
            // Création
            $stmt = $this->pdo->prepare("
                INSERT INTO {$this->table} (username, email, password)
                VALUES (:username, :email, :password)
            ");

            $result = $stmt->execute([
                'username' => $entity->getUsername(),
                'email' => $entity->getEmail(),
                'password' => $entity->getPassword()
            ]);

            if ($result) {
                $entity->id = (int) $this->pdo->lastInsertId();
            }

            return $result;
        }
    }
}
