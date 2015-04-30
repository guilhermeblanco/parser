<?php

namespace Doctrine\Language\Grammar\Rule\Body;

trait BodyAware
{
    /** @var callable|null */
    protected $transformer;

    /** @var integer */
    protected $priority;

    /**
     * @return callable|null
     */
    public function getTransformer()
    {
        return $this->transformer;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }
}