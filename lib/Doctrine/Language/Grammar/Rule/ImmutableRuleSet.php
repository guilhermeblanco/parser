<?php

namespace Doctrine\Language\Grammar\Rule;

use Doctrine\Language\Grammar\Rule\Body\MorphologicalBody;

class ImmutableRuleSet
{
    /** @var array */
    protected $rules;

    /** @var array */
    protected $terminalRules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules = [])
    {
        $this->terminalRules = [];
        $this->rules         = [];

        array_map(array($this, 'add'), $rules);
    }

    /**
     * @return array
     */
    public function getTerminalRules()
    {
        return $this->terminalRules;
    }

    /**
     * @param Rule $rule
     *
     * @return ImmutableRuleSet
     */
    protected function add(Rule $rule)
    {
        $this->rules[$rule->getName()] = $rule;

        if ($rule->isTerminal()) {
            $this->terminalRules[$rule->getName()] = $rule;
        }

        return $this;
    }
}