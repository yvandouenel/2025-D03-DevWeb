<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Diginamic\UserManagement\Model\User;
use Diginamic\UserManagement\Repository\UserRepository;

// Fonctions d'aide pour l'affichage
function displayUser(User $user): void
{
  echo "ID: {$user->getId()}, Username: {$user->getUsername()}, Email: {$user->getEmail()}, Créé le: {$user->getCreatedAt()}\n";
}

function displayUsers(array $users): void
{
  if (empty($users)) {
    echo "Aucun utilisateur trouvé.\n";
    return;
  }

  foreach ($users as $user) {
    displayUser($user);
  }
}

// Création du repository
$userRepo = new UserRepository();

// Démonstration des opérations CRUD
echo "=== Création d'un utilisateur ===\n";
$newUser = new User();
$newUser->setUsername('john_doe');
$newUser->setEmail('john@example.com');
$newUser->setPassword('secret123');

if ($userRepo->save($newUser)) {
  echo "Utilisateur créé avec succès! ID: {$newUser->getId()}\n";
} else {
  echo "Erreur lors de la création de l'utilisateur.\n";
}

echo "\n=== Recherche par ID ===\n";
$foundUser = $userRepo->findById($newUser->getId());
if ($foundUser) {
  displayUser($foundUser);
} else {
  echo "Utilisateur non trouvé.\n";
}

echo "\n=== Mise à jour de l'utilisateur ===\n";
$foundUser->setEmail('john.updated@example.com');
if ($userRepo->save($foundUser)) {
  echo "Utilisateur mis à jour avec succès!\n";
} else {
  echo "Erreur lors de la mise à jour de l'utilisateur.\n";
}

echo "\n=== Liste de tous les utilisateurs ===\n";
$allUsers = $userRepo->findAll();
displayUsers($allUsers);

echo "\n=== Authentification ===\n";
$authenticatedUser = $userRepo->authenticate('john_doe', 'secret123');
if ($authenticatedUser) {
  echo "Authentification réussie pour {$authenticatedUser->getUsername()}!\n";
} else {
  echo "Échec de l'authentification.\n";
}

echo "\n=== Suppression de l'utilisateur ===\n";
if ($userRepo->delete($newUser->getId())) {
  echo "Utilisateur supprimé avec succès!\n";
} else {
  echo "Erreur lors de la suppression de l'utilisateur.\n";
}

echo "\n=== Liste finale des utilisateurs ===\n";
$allUsers = $userRepo->findAll();
displayUsers($allUsers);
