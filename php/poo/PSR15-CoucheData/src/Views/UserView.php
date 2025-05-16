<?php

namespace Diginamic\Framework\Views;

class UserView
{
  public static function displayAllUsers($users)
  {
    // Syntaxe Herédoc
    $html = <<<HTML
      <h2 class="mb-4">Liste des utilisateurs</h2>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    HTML;

    foreach ($users as $user) {
      $html .= <<<HTML
        <div class="col">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <div class="d-flex gap-3">
                <h3 class="card-title">{$user->login}</h3>
                <a class="btn btn-warning" href="/users/update/{$user->id}">Modifier</a>
                <a class="btn btn-danger" href="/users/delete/{$user->id}">Supprimer</a>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="fw-bold">ID:</span> {$user->id}</li>
                <li class="list-group-item"><span class="fw-bold">Password:</span> {$user->password}</li>
                <li class="list-group-item"><span class="fw-bold">Email:</span> {$user->email}</li>
                <li class="list-group-item"><span class="fw-bold">Date de création:</span> {$user->createdAt}</li>
              </ul>
            </div>
          </div>
        </div>
      HTML;
    }

    $html .= <<<HTML
      </div>
    HTML;

    return $html;
  }

  public static function htmlUpdateForm($user)
  {
    $html = <<<HTML
      <form method="post" action="/users/update/{$user->id}" class="container py-4">
          <div class="row mb-3">
              <div class="col-md-6">
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="login" value="{$user->login}" name="login" required>
                      <label for="login">Login</label>
                  </div>
                  
                  <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="password" value="{$user->password}" name="password" required>
                      <label for="password">Password</label>
                  </div>
                  
                  <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" value="{$user->email}" name="email" required>
                      <label for="email">Email</label>
                  </div>
                  
                  <div class="d-grid gap-2 mt-4">
                      <button type="submit" class="btn btn-primary">Modifier</button>
                  </div>
              </div>
          </div>
      </form>
  HTML;

    return $html;
  }
}
