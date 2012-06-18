<?php
namespace Desymfony\Template;

abstract class MiTwigTemplate extends \Twig_Template
{
    public function render(array $context)
    {
        $trace = sprintf('<span data-host="%s" data-elapsed="%s sec." data-timestamp="%s"></span>',
            php_uname(),
            microtime(true)-$_SERVER['REQUEST_TIME'],
            microtime(true)
        );

        return str_replace('</body>', $trace."\n</body>", parent::render($context));
    }
}