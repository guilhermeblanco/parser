<?php

namespace Doctrine\Language;

abstract class Language
{
    /** @var Grammar\Grammar */
    protected $grammar;

    /**
     * @param string $input
     *
     * @return mixed
     */
    public function parse($input)
    {
        return $this->grammar->parse($input);
    }
}