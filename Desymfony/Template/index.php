<?php
namespace Desymfony\Template;

require_once __DIR__.'/../../vendor/autoload.php';

$loader = new \Twig_Loader_Filesystem(__DIR__.'/../Resources/views');
$twig = new \Twig_Environment($loader, array());

echo $twig->render('simple.twig');