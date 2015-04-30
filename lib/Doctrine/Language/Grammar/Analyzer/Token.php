<?php

namespace Doctrine\Language\Grammar\Analyzer;

final class Token
{
    /**
     * @var string
     */
    private $ruleName;

    /**
     * @var string
     */
    private $value;

    /**
     * @var integer
     */
    private $line;

    /**
     * @var integer
     */
    private $column;

    /**
     * @param string  $ruleName
     * @param string  $value
     * @param integer $line
     * @param integer $column
     */
    public function __construct($ruleName, $value, $line, $column)
    {
        $this->ruleName = $ruleName;
        $this->value    = $value;
        $this->line     = $line;
        $this->column   = $column;
    }

    /**
     * @return string
     */
    public function getRuleName()
    {
        return $this->ruleName;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return integer
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return integer
     */
    public function getColumn()
    {
        return $this->column;
    }
}