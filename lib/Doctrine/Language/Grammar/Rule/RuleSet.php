<?php

namespace Doctrine\Language\Grammar\Rule;

class RuleSet extends ImmutableRuleSet
{
    /**
     * @param Rule $rule
     *
     * @return RuleSet
     */
    public function add(Rule $rule)
    {
        return parent::add($rule);
    }
}