<?php

namespace Doctrine\Language\Grammar\Analyzer;

class TokenIterator implements \Iterator, \Countable
{
    /** @var array */
    private $tokens;

    /**
     * @param array $tokens
     */
    public function __construct(array $tokens = [])
    {
        $this->tokens = $tokens;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->tokens);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return next($this->tokens);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->tokens);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        $key = key($this->tokens);

        return ($key !== null && $key !== false);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        reset($this->tokens);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->tokens);
    }
}