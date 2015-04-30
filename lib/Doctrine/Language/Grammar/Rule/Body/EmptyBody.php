<?php

namespace Doctrine\Language\Grammar\Rule\Body;

use Doctrine\Language\Grammar\Analyzer\TokenIterator;
use Doctrine\Language\Grammar\Attribute\Attribute;

/**
 * Rule ::= ε
 *
 * @package Doctrine\Language\Grammar\Rule\Body
 */
class EmptyBody implements GrammemeBody
{
    use BodyAware;

    /**
     * @param TokenIterator $tokenIterator
     *
     * @return Attribute
     */
    function parse(TokenIterator $tokenIterator)
    {
        // TODO: Implement parse() method.
    }
}