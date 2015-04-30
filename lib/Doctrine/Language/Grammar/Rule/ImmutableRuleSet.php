<?php

namespace Doctrine\Language\Grammar\Rule;

use Doctrine\Language\Grammar\Rule\Body\MorphologicalBody;

class ImmutableRuleSet
{
    /** @var array */
    protected $rules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules = [])
    {
        $this->rules = [];

        array_map(array($this, 'add'), $rules);
    }

    /**
     * @return ImmutableRuleSet
     */
    public function getTerminalRuleSet()
    {
        $terminalRules = array_filter($this->rules, function (Rule $rule) { return $rule->isTerminal(); });

        // Terminal rules must always be prioritized
        uasort($terminalRules, function (Rule $firstRule, Rule $secondRule) {
            return $firstRule->getBody()->getPriority() - $secondRule->getBody()->getPriority();
        });

        return new ImmutableRuleSet($terminalRules);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->rules;
    }

    /**
     * @param Rule $rule
     *
     * @return ImmutableRuleSet
     */
    protected function add(Rule $rule)
    {
        $this->rules[$rule->getName()] = $rule;

        return $this;
    }
}