<?php

namespace Doctrine\Language\Grammar\Rule\Body;

interface MorphemeBody extends Body
{
    /**
     * @return string
     */
    function getMorpheme();

    /**
     * @param string $value
     *
     * @return boolean
     */
    function isMorpheme($value);
}