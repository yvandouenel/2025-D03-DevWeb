<?php

namespace Diginamic\UserManagement\Model;

class User {
    public ?int $id = null;
    public string $username;
    public string $email;
    public string $password;
    public string $created_at;

    public function __construct(array $data = []) {
        // Hydratation du modèle si des données sont fournies
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }
    
    public function hydrate(array $data): void {
        foreach ($data as $key => $value) {
            // Convertir snake_case en camelCase si nécessaire
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            } else if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    // Getters et Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): self {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): self {
        // En production, utilisez password_hash() ici
        $this->password = $password;
        return $this;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }
}