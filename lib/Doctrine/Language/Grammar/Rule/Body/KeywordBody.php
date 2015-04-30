<?php

namespace Doctrine\Language\Grammar\Rule\Body;

class KeywordBody implements MorphemeBody
{
    use BodyAware;

    /** @var string */
    protected $morpheme;

    /**
     * @param string   $morpheme
     * @param integer  $priority
     * @param callable $transformer
     */
    public function __construct($morpheme, $priority = -127, callable $transformer = null)
    {
        $this->morpheme    = $morpheme;
        $this->priority    = $priority;
        $this->transformer = $transformer;
    }

    /**
     * @return string
     */
    function getMorpheme()
    {
        return $this->morpheme;
    }

    /**
     * @param string $value
     *
     * @return boolean
     */
    function isMorpheme($value)
    {
        return strcasecmp($value, $this->morpheme) === 0;
    }
}