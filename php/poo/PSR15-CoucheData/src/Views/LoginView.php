<?php

namespace Diginamic\Framework\Views;

class LoginView
{
  public static function displayLoginForm($title)
  {
    $html = <<<HTML
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">{$title}</h2>
                        
                        <form method="post" action="/login-post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="login" name="login" required>
                                <label for="login">Votre login</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <label for="password">Votre mot de passe</label>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Connexion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    HTML;

    return $html;
  }
}
