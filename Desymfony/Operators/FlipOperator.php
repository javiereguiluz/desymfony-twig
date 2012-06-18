<?php
namespace Desymfony\Operators;

class FlipOperator extends \Twig_Node_Expression_Unary
{
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->raw("array_flip(")
            ->subcompile($this->getNode('node'))        
            ->raw(")\n")
        ;

    }

    public function operator(\Twig_Compiler $compiler)
    {
        $compiler->raw('<->');
    }
}