<?php

namespace Doctrine\Language\Grammar\Rule\Body;

use Doctrine\Language\Grammar\Analyzer\TokenIterator;
use Doctrine\Language\Grammar\Attribute\Attribute;

interface GrammemeBody extends Body
{
    /**
     * @param TokenIterator $tokenIterator
     *
     * @return Attribute
     */
    function parse(TokenIterator $tokenIterator);
}