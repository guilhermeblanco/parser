<?php

namespace Doctrine\Language\Grammar\Analyzer;

use Doctrine\Language\Grammar\Attribute;

interface SemanticAnalyzer
{
    /**
     * @param Attribute\Attribute $attribute
     *
     * @return Attribute\Attribute
     */
    function analyze(Attribute\Attribute $attribute);
}