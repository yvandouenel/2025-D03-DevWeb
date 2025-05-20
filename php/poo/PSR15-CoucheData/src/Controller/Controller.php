<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Middleware\AuthMiddleware;
use Diginamic\Framework\Services\NavigationService;
use Twig\Environment;

abstract class Controller
{
  protected NavigationService $navService;
  protected Environment $twig;
}
