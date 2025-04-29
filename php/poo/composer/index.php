<?php
include_once 'vendor/autoload.php';

use Diginamic\Poo\MyClass;
use Entities\MyClass as EntitiesMyClass;


$a = new MyClass();
$b = new EntitiesMyClass();
var_dump($a);
var_dump($b);
