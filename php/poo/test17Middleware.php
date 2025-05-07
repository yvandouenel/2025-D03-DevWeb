<?php

$request = "initial request";

function controller($request)
{
  return "response";
}

function middleware1($request, $next)
{
  // Modify the request
  $request .= "1";
  echo $request . PHP_EOL;

  // Call next middleware and modify response
  $response = $next($request);

  // Modify the response
  return $response .= "1";
}

function middleware2($request, $next)
{
  // Modify the request
  $request .= "2" . PHP_EOL;
  echo $request;

  // Call next middleware and modify response
  $response = $next($request);

  // Modify the response
  return $response .= "2";
}

// Create the pipeline
$middlewarePipeline = [
  'middleware1',
  'middleware2'
];

// Execute the pipeline
$pipeline = array_reduce(
  array_reverse($middlewarePipeline),
  function ($next, $middleware) {
    return function ($request) use ($middleware, $next) {
      return $middleware($request, $next);
    };
  },
  'controller'
);

$result = $pipeline($request);

echo $result;
