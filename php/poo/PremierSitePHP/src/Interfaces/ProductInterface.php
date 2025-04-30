<?php

namespace Diginamic\Interfaces;

interface ProductInterface
{
  public function getId();
  public function getName();
  public function getPrice();
  public function getDescription();
  public function isAvailable();
}
