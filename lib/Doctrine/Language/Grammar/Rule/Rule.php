<?php

namespace Doctrine\Language\Grammar\Rule;

use Doctrine\Language\Grammar\Rule\Body\Body;

interface Rule
{
    /**
     * @return string
     */
    function getName();

    /**
     * @return Body
     */
    function getBody();

    /**
     * @return boolean
     */
    function isTerminal();
}