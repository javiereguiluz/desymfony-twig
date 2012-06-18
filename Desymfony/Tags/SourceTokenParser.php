<?php
namespace Desymfony\Tags;

use Desymfony\Tags\SourceNode;

class SourceTokenParser extends \Twig_TokenParser
{
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $value  = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new SourceNode($value, $lineno, $this->getTag());
    }

    public function getTag()
    {
        return 'source';
    }
}