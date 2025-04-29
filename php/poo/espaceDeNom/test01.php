<?php

namespace MyProject;

include_once('test03.php');


function myFunction()
{
  echo "Je suis dans la fonction myFunction de l'espace de nom MyProject" . PHP_EOL;
}
// Appel à la fonction de l'espace de nom MyProject
myFunction();

// Appel à la fonction de l'espace de nom global
\myFunction();
