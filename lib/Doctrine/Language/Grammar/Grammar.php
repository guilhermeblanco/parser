<?php

namespace Doctrine\Language\Grammar;

interface Grammar
{
    /**
     * @param string $input
     *
     * @return Attribute\Attribute
     */
    function parse($input);
}