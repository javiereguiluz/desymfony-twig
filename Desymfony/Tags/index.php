<?php
namespace Desymfony\Tags;

use Desymfony\Tags\SourceTokenParser;
require_once __DIR__.'/../../vendor/autoload.php';

$loader = new \Twig_Loader_Filesystem(__DIR__.'/../Resources/views');
$twig = new \Twig_Environment($loader, array());
$twig->addTokenParser(new SourceTokenParser());

echo $twig->render('tags.twig');