<?php

namespace Doctrine\Language\Grammar\Analyzer;

use Doctrine\Language\Exception\LexicalException;
use Doctrine\Language\Grammar\Rule;

class LexicalAnalyzer
{
    /**
     * @param Rule\ImmutableRuleSet $terminalRuleSet
     * @param string                $input
     *
     * @return TokenIterator
     */
    public function analyze(Rule\ImmutableRuleSet $terminalRuleSet, $input)
    {
        // Retrieve morphemes
        $terminalMorphemes = array_map(function (Rule\Rule $terminalRule) {
            return $terminalRule->getBody()->getMorpheme();
        }, $terminalRuleSet->toArray());

        $regex  = sprintf('/(%s)/i', implode(')|(', $terminalMorphemes));
        $flags  = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
        $lines  = preg_split('/\R/', $input, -1, PREG_SPLIT_NO_EMPTY);
        $tokens = [];

        foreach ($lines as $lineNumber0 => $lineInput) {
            $matches = preg_split($regex, $lineInput, -1, $flags);

            array_walk($matches, function (&$match) use ($lineNumber0, &$tokens, $terminalRuleSet) {
                // [0] => value, [1] => offset, [2] => line
                $match[2] = $lineNumber0 + 1;

                if (null !== ($token = $this->createToken($match, $terminalRuleSet))) {
                    $tokens[] = $token;
                }
            });
        }

        return new TokenIterator($tokens);
    }

    /**
     * @param array                 $match
     * @param Rule\ImmutableRuleSet $terminalRuleSet
     *
     * @return null|Token
     */
    private function createToken(array $match, Rule\ImmutableRuleSet $terminalRuleSet)
    {
        // Iterate through all terminal rules to find matching morpheme
        foreach ($terminalRuleSet->toArray() as $terminalRule) {
            $body = $terminalRule->getBody();

            if (! $body->isMorpheme($match[0])) {
                continue;
            }

            // In certain scenarios, matched value needs to be transformed (ie. quoted strings)
            $transformer = $body->getTransformer();
            $value       = $transformer !== null ? $transformer($match[0]) : $match[0];

            return new Token($terminalRule->getName(), $value, $match[2], $match[1]);
        }

        // Special case for white space, tabs, etc. Discard element as it's not meant to be caught
        if (preg_match('/^\s+$/', $match[0])) {
            return null;
        }

        throw new LexicalException(sprintf('Unknown token value "%s".', $match[0]));
    }
}