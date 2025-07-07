<?php

use PHPUnit\Framework\TestCase;
use Diginamic\Framework\Services\TokenService;

class TokenServiceTest extends TestCase
{
  private TokenService $tokenService;

  protected function setUp(): void
  {
    $this->tokenService = new TokenService();
  }

  /**
   * Test simple : vérifie qu'un token est bien créé
   */
  public function testCreateTokenReturnsString()
  {
    $token = $this->tokenService->createToken();

    // Vérifie que le token n'est pas vide
    $this->assertNotEmpty($token);

    // Vérifie que c'est bien une chaîne de caractères
    $this->assertIsString($token);
  }

  /**
   * Test : vérifie que chaque appel génère un token différent
   */
  public function testCreateTokenGeneratesUniqueTokens()
  {
    $token1 = $this->tokenService->createToken();
    $token2 = $this->tokenService->createToken();

    // Les deux tokens doivent être différents
    $this->assertNotEquals($token1, $token2);
  }

  /**
   * Test : vérifie la longueur du token (MD5 = 32 caractères)
   */
  public function testCreateTokenHasCorrectLength()
  {
    $token = $this->tokenService->createToken();

    // Un hash MD5 fait toujours 32 caractères
    $this->assertEquals(32, strlen($token));
  }

  /**
   * Test : vérifie que le token ne contient que des caractères hexadécimaux
   */
  public function testCreateTokenContainsOnlyHexCharacters()
  {
    $token = $this->tokenService->createToken();

    // Vérifie que le token ne contient que des caractères 0-9 et a-f
    $this->assertMatchesRegularExpression('/^[a-f0-9]{32}$/', $token);
  }
}
