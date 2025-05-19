<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Middleware\AuthMiddleware;
use Diginamic\Framework\Services\NavigationService;

abstract class Controller
{
  protected NavigationService $navService;
}
