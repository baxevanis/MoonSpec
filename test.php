<?php

include_once('vendor/autoload.php');


use MoonSpec\MoonLibrary;


$moonLib = new MoonLibrary();

$aha = $moonLib->getPhase();
var_dump($aha);
die('a');