<?php

namespace Diginamic\Framework\Repository;

use Diginamic\Framework\Model\User;
use PDO;

class UserRepository extends AbstractRepository
{
  protected string $table = 'users';
  protected string $entityClass = User::class;


  /**
   * Trouver un utilisateur par son login
   */
  public function findByLogin(string $login): ?User
  {
    $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = :login LIMIT 1");
    $stmt->execute(['login' => $login]);


    $stmt->setFetchMode(PDO::FETCH_CLASS, $this->entityClass);

    $user = $stmt->fetch();
    return $user ?: null;
  }

  /**
   * Authentifier un utilisateur
   */
  public function authenticate(string $login, string $password): ?User
  {
    $user = $this->findByLogin($login);
    // Utilisation de password_verify() pour comparer les mots de passe hachés
    if ($user && password_verify(
      $password,
      $user->password
    )) {
      return $user;
    }

    return null;
  }


  /**
   * Sauvegarder un utilisateur (création ou mise à jour)
   */
  public function save(object $entity): bool
  {
    if (!$entity instanceof User) {
      throw new \InvalidArgumentException('L\'entité doit être une instance de User');
    }

    if ($entity->id) {
      // Mise à jour
      $stmt = $this->db->prepare("
                UPDATE {$this->table} 
                SET login = :login, password = :password, email = :email 
                WHERE id = :id
            ");

      return $stmt->execute([
        'id' => $entity->id,
        'login' => $entity->login,
        'password' => password_hash($entity->password, PASSWORD_BCRYPT),
        'email' => $entity->email
      ]);
    } else {
      // Création d'une requête préparée ou paramétrée
      $stmt = $this->db->prepare("
                INSERT INTO {$this->table} (login, password, email, created_at) 
                VALUES (:login, :password, :email, NOW())
            ");

      $result = $stmt->execute([
        'login' => $entity->login,
        'password' => password_hash($entity->password, PASSWORD_BCRYPT),
        'email' => $entity->email
      ]);

      if ($result) {
        $entity->id = (int) $this->db->lastInsertId();
      }

      return $result;
    }
  }
}
