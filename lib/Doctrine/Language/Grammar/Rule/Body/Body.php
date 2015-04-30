<?php

namespace Doctrine\Language\Grammar\Rule\Body;

interface Body
{
    /**
     * @return integer
     */
    function getPriority();

    /**
     * @return null|callable
     */
    function getTransformer();
}