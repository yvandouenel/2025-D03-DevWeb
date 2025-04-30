<?php

namespace Diginamic\Views;

class ProductView
{
  public function displayProducts($products)
  {
    $html = '<div class="container mt-4">';
    $html .= '<h2 class="mb-4">Liste des produits</h2>';

    if (empty($products)) {
      $html .= '<div class="alert alert-info">Aucun produit disponible.</div>';
    } else {
      $html .= '<div class="row">';

      foreach ($products as $product) {
        $availabilityClass = $product->isAvailable() ? 'badge bg-success' : 'badge bg-danger';
        $availabilityText = $product->isAvailable() ? 'Disponible' : 'Indisponible';

        $html .= '<div class="col-md-4 mb-4">';
        $html .= '<div class="card h-100">';
        $html .= '<div class="card-body">';
        $html .= '<h5 class="card-title">' . htmlspecialchars($product->getName()) . '</h5>';
        $html .= '<p class="card-text">' . htmlspecialchars($product->getDescription()) . '</p>';
        $html .= '<p class="card-text"><strong>Prix : </strong>' . number_format($product->getPrice(), 2, ',', ' ') . ' €</p>';
        $html .= '<span class="' . $availabilityClass . '">' . $availabilityText . '</span>';
        $html .= '</div>';
        $html .= '<div class="card-footer">';
        $html .= '<a href="?controller=products&id=' . $product->getId() . '" class="btn btn-primary">Voir détails</a>';
        $html .= '</div>';
        $html .= '</div>'; // fin card
        $html .= '</div>'; // fin col
      }

      $html .= '</div>'; // fin row
    }

    $html .= '</div>'; // fin container

    return $html;
  }
}
