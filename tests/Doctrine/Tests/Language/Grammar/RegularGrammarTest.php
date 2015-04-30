<?php

namespace Doctrine\Tests\Language\Grammar;

use Doctrine\Language\Grammar\Analyzer\TokenIterator;
use Doctrine\Language\Grammar\RegularGrammar;
use Doctrine\Language\Grammar\Rule;
use Doctrine\Language\Grammar\Rule\Body;
use Doctrine\Tests\DoctrineTestCase;

class RegularGrammarTest extends DoctrineTestCase
{
    public function testEmptyRuleSet()
    {
        $ruleSet = new Rule\RuleSet();
        $grammar = new RegularGrammar($ruleSet);

        $this->assertEmpty($grammar->getTerminalRules());

        $this->setExpectedException('Doctrine\Language\Exception\LexicalException');

        $grammar->parse('This is Sparta!');
    }

    public function testIdentifierRuleSet()
    {
        $ruleSet = new Rule\RuleSet();

        $ruleSet->add(new Rule\TerminalRule(
            'IDENTIFIER',
            new Body\IdentifierBody("[a-z_\\\][a-z0-9_\:\\\]*[a-z_][a-z0-9_]*")
        ));

        $grammar = new RegularGrammar($ruleSet);
        $result  = $grammar->parse("This is Sparta");

        $this->assertInstanceOf(TokenIterator::CLASS, $result);
    }
}