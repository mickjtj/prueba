<?php

// Autoloadre
require_once __DIR__.'/vendor/autoload.php';

// Constantes
require_once __DIR__.'/constants.php';

// Plantillas
$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');

 // Twig
$twig = new Twig_Environment($loader);