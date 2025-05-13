<?php

namespace Diginamic\Framework\Model;

class User
{
  public ?int $id = null;
  public string $login;
  public string $password; // En production, utiliser un hash
  public string $email;
  public ?string $created_at = null;
}
