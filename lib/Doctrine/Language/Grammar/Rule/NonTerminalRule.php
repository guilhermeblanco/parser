<?php

namespace Doctrine\Language\Grammar\Rule;

use Doctrine\Language\Grammar\Rule\Body\GrammemeBody;

class NonTerminalRule implements Rule
{
    use RuleAware;

    /**
     * @param string       $name
     * @param GrammemeBody $body
     */
    public function __construct($name, GrammemeBody $body)
    {
        $this->name = $name;
        $this->body = $body;
    }

    /**
     * {@inheritdoc}
     */
    public function isTerminal()
    {
        return false;
    }
}