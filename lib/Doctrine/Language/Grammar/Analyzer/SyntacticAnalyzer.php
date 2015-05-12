<?php

namespace Doctrine\Language\Grammar\Analyzer;

use Doctrine\Language\Grammar\Attribute;
use Doctrine\Language\Grammar\Rule;

class SyntacticAnalyzer
{
    /**
     * @param Rule\ImmutableRuleSet $terminalRuleSet
     * @param TokenIterator         $tokenIterator
     *
     * @return Attribute\Attribute
     */
    public function analyze(Rule\ImmutableRuleSet $terminalRuleSet, TokenIterator $tokenIterator)
    {

    }
}