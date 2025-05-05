<?php

return [
  [
    "path" => '/',
    "controller" => 'Diginamic\Framework\Controller\HomeController',
    "controllerMethod" => 'index',
    "httpMethod" => 'GET'
  ],
  [
    "path" => '/uri-infos',
    "controller" => 'Diginamic\Framework\Controller\FirstController',
    "controllerMethod" => 'handleRequest',
    "httpMethod" => 'GET'
  ],
  [
    "path" => '/test-post',
    "controller" => 'Diginamic\Framework\Controller\FirstController',
    "controllerMethod" => 'testPost',
    "httpMethod" => 'GET'
  ],
  [
    "path" => '/test-post',
    "controller" => 'Diginamic\Framework\Controller\FirstController',
    "controllerMethod" => 'testPost',
    "httpMethod" => 'POST'
  ],
  [
    "path" => '/test-put',
    "controller" => 'Diginamic\Framework\Controller\FirstController',
    "controllerMethod" => 'testPut',
    "httpMethod" => 'GET'
  ],
  [
    "path" => '/test-put/{id}',
    "controller" => 'Diginamic\Framework\Controller\FirstController',
    "controllerMethod" => 'testPut',
    "httpMethod" => 'PUT',
    "params" => [
      "id" => "[0-9]+"  // Expression régulière pour s'assurer que l'ID est un nombre
    ]
  ]
];
