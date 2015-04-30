<?php

namespace Doctrine\Language\Grammar\Rule\Body;

use Doctrine\Language\Grammar\Analyzer\TokenIterator;
use Doctrine\Language\Grammar\Attribute\Attribute;

/**
 * Rule ::= Body1 | Body2 | ... | BodyN
 *
 * @package Doctrine\Language\Grammar\Rule\Body
 */
class AlternateBody implements GrammemeBody
{
    use BodyAware;

    /** @var array */
    private $bodies;

    /**
     * @param array $bodies
     */
    public function __construct(array $bodies)
    {
        $this->bodies = [];

        array_map(function (Body $body) {
            $this->add($body);
        }, $bodies);
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

    /**
     * @param Body $body
     */
    private function add(Body $body)
    {
        $this->bodies[] = $body;
    }
}