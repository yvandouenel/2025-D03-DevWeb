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
              <h5 class="card-title">{$user->login}</h5>
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
}
