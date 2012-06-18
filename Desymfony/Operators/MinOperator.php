<?php
namespace Desymfony\Operators;

class MinOperator extends \Twig_Node_Expression_Binary
{
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->raw('min(')
            ->subcompile($this->getNode('left'))
            ->raw(', ')
            ->subcompile($this->getNode('right'))
            ->raw(')')
        ;
    }

    public function operator(\Twig_Compiler $compiler)
    {
        return $compiler->raw('<');
    }
}