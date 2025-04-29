<?php
include_once('test01.php');

function myFunction()
{
  echo 'Jes suis dans la fonction MyFunction de l\'espace de nom global' . PHP_EOL;
}

MyFunction();
MyProject\MyFunction();
