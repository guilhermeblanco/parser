<?php

namespace Doctrine\Language\Grammar\Rule\Body;

use Doctrine\Language\Grammar\Analyzer\TokenIterator;
use Doctrine\Language\Grammar\Attribute\Attribute;

/**
 * Rule ::= [Body]
 *
 * @package Doctrine\Language\Grammar\Rule\Body
 */
class OptionalBody implements GrammemeBody
{
    use BodyAware;

    /** @var Body */
    private $body;

    /**
     * @param Body $body
     */
    function __construct(Body $body)
    {
        $this->body = $body;
    }

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