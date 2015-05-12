<?php

namespace Doctrine\Tests\Language\Grammar\Analyzer;

use Doctrine\Language\Grammar\Analyzer;
use Doctrine\Language\Grammar\Rule;
use Doctrine\Language\Grammar\Rule\Body;
use Doctrine\Tests\DoctrineTestCase;

class LexicalAnalyzerTest extends DoctrineTestCase
{
    public function testEmptyRuleSet()
    {
        $ruleSet = new Rule\RuleSet();

        $this->assertRuleSetWithInvalidInput($ruleSet, 'This is Sparta');
    }

    public function testIdentifierRuleSet()
    {
        $ruleSet = new Rule\RuleSet();

        $ruleSet
            ->add(new Rule\TerminalRule('IDENTIFIER', new Body\IdentifierBody("[a-z_\\\][a-z0-9_\:\\\]*[a-z_][a-z0-9_]*")))
        ;

        $this->assertRuleSetWithInput($ruleSet, 'This is Sparta', 3);
    }

    public function testKeywordRuleSet()
    {
        $ruleSet = new Rule\RuleSet();

        $ruleSet
            ->add(new Rule\TerminalRule('THIS', new Body\KeywordBody("This")))
            ->add(new Rule\TerminalRule('IS', new Body\KeywordBody("is")))
            ->add(new Rule\TerminalRule('SPARTA', new Body\KeywordBody("Sparta")))
        ;

        $this->assertRuleSetWithInput($ruleSet, 'This is Sparta', 3);
    }

    public function testMixedRuleSet()
    {
        $ruleSet = new Rule\RuleSet();

        $ruleSet
            ->add(new Rule\TerminalRule('THIS', new Body\KeywordBody("This")))
            ->add(new Rule\TerminalRule('IDENTIFIER', new Body\IdentifierBody("[a-z_\\\][a-z0-9_\:\\\]*[a-z_][a-z0-9_]*"))
        );

        $this->assertRuleSetWithInput($ruleSet, 'This is Sparta', 3);
    }

    public function testInvalidInput()
    {
        $ruleSet = new Rule\RuleSet();

        $ruleSet
            ->add(new Rule\TerminalRule('IDENTIFIER', new Body\IdentifierBody("[a-z_\\\][a-z0-9_\:\\\]*[a-z_][a-z0-9_]*")))
        ;

        $this->assertRuleSetWithInvalidInput($ruleSet, 'This is Sparta 300');
    }

    /**
     * @param Rule\RuleSet $ruleSet
     * @param string       $input
     */
    protected function assertRuleSetWithInvalidInput(Rule\RuleSet $ruleSet, $input)
    {
        $analyzer = new Analyzer\LexicalAnalyzer();

        $this->setExpectedException('Doctrine\Language\Exception\LexicalException');

        $analyzer->analyze($ruleSet, $input);
    }

    /**
     * @param Rule\RuleSet $ruleSet
     * @param string       $input
     * @param integer      $tokenCount
     * @param null|array   $types
     */
    protected function assertRuleSetWithInput(Rule\RuleSet $ruleSet, $input, $tokenCount, $types = null)
    {
        $analyzer = new Analyzer\LexicalAnalyzer();
        $result   = $analyzer->analyze($ruleSet, $input);

        $this->assertInstanceOf(Analyzer\TokenIterator::CLASS, $result);
        $this->assertCount($tokenCount, $result);
    }
}