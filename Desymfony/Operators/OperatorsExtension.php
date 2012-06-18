<?php
namespace Desymfony\Operators;

class OperatorsExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'OperadoresPropiosExtension';
    }

    public function getOperators()
    {
        return array(
            // operadores unarios
            array(
                '<->' => array(
                    'precedence'    => 50,
                    'class'         => 'Desymfony\Operators\FlipOperator'
                ),  
            ),
            // operadores binarios
            array(
                '>>' => array(
                    'precedence'    => 20,
                    'class'         => 'Desymfony\Operators\MaxOperator',
                    'associativity' => \Twig_ExpressionParser::OPERATOR_LEFT
                ),
                '<<' => array(
                    'precedence'    => 20,
                    'class'         => 'Desymfony\Operators\MinOperator',
                    'associativity' => \Twig_ExpressionParser::OPERATOR_LEFT
                ),
            )
        );
    }
}