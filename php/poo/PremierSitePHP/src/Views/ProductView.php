<?php

namespace Diginamic\Views;

class ProductView
{
  public function displayProducts($products)
  {
    $html = '<h2>Liste des produits<h2>';
    $html .= '<ul>';
    foreach ($products as $product) {
      $html .= ' <li>';
      $html .=  $product->getName();

      $html .= ' </li>';
    }

    $html .= '</ul>';

    return $html;
  }
}
