<?php

namespace Doctrine\Language\Grammar\Rule;

use Doctrine\Language\Grammar\Rule\Body\MorphemeBody;

class TerminalRule implements Rule
{
    use RuleAware;

    /**
     * @param string       $name
     * @param MorphemeBody $body
     */
    public function __construct($name, MorphemeBody $body)
    {
        $this->name = $name;
        $this->body = $body;
    }

    /**
     * {@inheritdoc}
     */
    public function isTerminal()
    {
        return true;
    }
}