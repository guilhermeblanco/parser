<?php

namespace Doctrine\Language;

abstract class Language
{
    /** @var Grammar\Grammar */
    protected $grammar;

    /**
     * @param string $input
     */
    public function parse($input)
    {
        $attribute = $this->grammar->parse($input);

        echo '<pre>';
        var_dump($attribute);
        echo '</pre>';
    }
}