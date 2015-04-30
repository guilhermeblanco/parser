<?php

namespace Doctrine\Language\Grammar;

use Doctrine\Language\Grammar\Analyzer;
use Doctrine\Language\Grammar\Attribute;
use Doctrine\Language\Grammar\Rule\ImmutableRuleSet;

class RegularGrammar implements Grammar
{
    /** @var Rule\RuleSet */
    protected $ruleSet;

    /**
     * @param Rule\RuleSet $ruleSet
     */
    public function __construct(Rule\RuleSet $ruleSet)
    {
        $this->ruleSet = $ruleSet;
    }

    /**
     * @param string $input
     *
     * @return Attribute\Attribute
     */
    public function parse($input)
    {
        $lexicalAnalyzer = $this->getLexicalAnalyzer();
        $tokenIterator   = $lexicalAnalyzer->analyze($this->ruleSet->getTerminalRuleSet(), $input);
        //$attribute     = $this->syntacticAnalyzer->analyze($tokenIterator);

        //return $this->semanticAnalyzer->analyze($attribute);
        return $tokenIterator;
    }

    protected function getLexicalAnalyzer()
    {
        return new Analyzer\LexicalAnalyzer();
    }
}