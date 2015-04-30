<?php

namespace Doctrine\Language\Grammar\Analyzer;

interface SyntacticAnalyzer
{
    function analyze(TokenIterator $tokenIterator);
}