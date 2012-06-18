<?php
namespace Desymfony\Operators;

use Desymfony\Operators\OperatorsExtension;
require_once __DIR__.'/../../vendor/autoload.php';

$loader = new \Twig_Loader_Filesystem(__DIR__.'/../Resources/views');
$twig = new \Twig_Environment($loader, array());
$twig->addExtension(new OperatorsExtension());

echo $twig->render('operators.twig');