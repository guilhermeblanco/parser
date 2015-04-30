<?php

namespace Doctrine\Language\Grammar;

interface Grammar
{
    /**
     * @return array
     */
    function getTerminalRules();

    /**
     * @param string $input
     *
     * @return Attribute\Attribute
     */
    function parse($input);
}