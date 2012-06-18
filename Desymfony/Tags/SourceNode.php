<?php
namespace Desymfony\Tags;

class SourceNode extends \Twig_Node
{
    public function __construct(\Twig_Node_Expression $value, $lineno, $tag = null)
    {
        parent::__construct(array('file' => $value), array(), $lineno, $tag);
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("\$paths = \$this->env->getLoader()->getPaths();\n")
            ->write("\$basepath = \$paths[0];\n")
            ->write('// incluir el código fuente del siguiente archivo: $basepath.')->subcompile($this->getNode('file'))->raw(";\n")
            ->write('echo file_get_contents($basepath."/".')->subcompile($this->getNode('file'))->raw(');');
        ;
    }
}