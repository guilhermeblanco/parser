<?php

namespace Doctrine\Language\Grammar\Analyzer;

use Doctrine\Language\Exception\LexicalException;
use Doctrine\Language\Grammar\Grammar;
use Doctrine\Language\Grammar\Rule\Rule;

class LexicalAnalyzer
{
    /**
     * @param Grammar $grammar
     * @param string  $input
     *
     * @return TokenIterator
     */
    public function analyze(Grammar $grammar, $input)
    {
        // Prioritize grammar terminal rules
        $terminalRules = $grammar->getTerminalRules();

        uasort($terminalRules, function (Rule $firstRule, Rule $secondRule) {
            return $firstRule->getBody()->getPriority() - $secondRule->getBody()->getPriority();
        });

        // Retrieve morphemes
        $terminalMorphemes = array_map(function (Rule $rule) {
            return $rule->getBody()->getMorpheme();
        }, $terminalRules);

        $regex  = sprintf('/(%s)/i', implode(')|(', $terminalMorphemes));
        $flags  = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
        $lines  = preg_split('/\R/', $input, -1, PREG_SPLIT_NO_EMPTY);
        $tokens = [];

        foreach ($lines as $lineNumber0 => $lineInput) {
            $matches = preg_split($regex, $lineInput, -1, $flags);

            foreach ($matches as $match) {
                // [0] => value, [1] => offset, [2] => line
                $match[2] = $lineNumber0 + 1;

                $token = $this->createToken($match, $terminalRules);

                if ($token) {
                    $tokens[] = $token;
                }
            }
        }

        return new TokenIterator($tokens);
    }

    /**
     * @param array $match
     * @param array $terminalRules
     *
     * @return Token
     */
    private function createToken(array $match, array $terminalRules)
    {
        // Iterate through all terminal rules to find matching morpheme
        foreach ($terminalRules as $rule) {
            $body = $rule->getBody();

            if (! $body->isMorpheme($match[0])) {
                continue;
            }

            // In certain scenarios, matched value needs to be transformed (ie. quoted strings)
            $transformer = $body->getTransformer();

            return new Token($transformer !== null ? $transformer($match[0]) : $match[0], $match[2], $match[1]);
        }

        // Special case for white space, tabs, etc. Discard element as it's not meant to be caught
        if (preg_match('/\s+/', $match[0])) {
            return null;
        }

        throw new LexicalException(sprintf('Unknown token value "%s".', $match[0]));
    }
}