<?php

namespace Doctrine\Language\Grammar\Rule;

use Doctrine\Language\Grammar\Rule\Body\Body;

trait RuleAware
{
    /** @var string */
    protected $name;

    /** @var Body */
    protected $body;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Body
     */
    public function getBody()
    {
        return $this->body;
    }
}