<?php

namespace Doctrine\Tests\Language;

use Doctrine\Language\Language;
use Doctrine\Language\Grammar;
use Doctrine\Language\Grammar\Rule;
use Doctrine\Language\Grammar\Rule\Body;

class AnnotationLanguage extends Language
{
    public function __construct()
    {
        $ruleSet = new Rule\RuleSet();

        $ruleSet
            // Keywords
            ->add(new Rule\TerminalRule('OPEN_PARENTHESIS', new Body\KeywordBody('\(')))
            ->add(new Rule\TerminalRule('CLOSE_PARENTHESIS', new Body\KeywordBody('\)')))
            ->add(new Rule\TerminalRule('OPEN_BRACKET', new Body\KeywordBody('\{')))
            ->add(new Rule\TerminalRule('CLOSE_BRACKET', new Body\KeywordBody('\}')))
            ->add(new Rule\TerminalRule('AT', new Body\KeywordBody('@')))
            ->add(new Rule\TerminalRule('FALSE', new Body\KeywordBody('false')))
            ->add(new Rule\TerminalRule('TRUE', new Body\KeywordBody('true')))
            ->add(new Rule\TerminalRule('NULL', new Body\KeywordBody('null')))
            // Identifiers
            ->add(new Rule\TerminalRule(
                'IDENTIFIER',
                new Body\IdentifierBody("[a-z_\\\][a-z0-9_\:\\\]*[a-z_][a-z0-9_]*")
            ))
            ->add(new Rule\TerminalRule(
                'NUMBER',
                new Body\IdentifierBody("(?:[+-]?[0-9]+(?:[\.][0-9]+)*)(?:[eE][+-]?[0-9]+)?")
            ))
            ->add(new Rule\TerminalRule(
                'SINGLE_QUOTED_STRING',
                new Body\IdentifierBody("'(?:[^']|'')*'", -127, function ($value) {
                    return str_replace("''", "'", substr($value, 1, strlen($value) - 2));
                })
            ))
            ->add(new Rule\TerminalRule(
                'DOUBLE_QUOTED_STRING',
                new Body\IdentifierBody('"(?:[^"]|"")*"', -127, function ($value) {
                    return str_replace('""', '"', substr($value, 1, strlen($value) - 2));
                })
            ))
            // Rules
            ->add(new Rule\NonTerminalRule(
                'Annotations',
                new Body\AlternateBody(
                    new Body\SequenceBody([
                        new Body\RuleBody('Annotation'),
                        new Body\RuleBody('Annotations'),
                    ]),
                    new Body\EmptyBody()
                )
            ))
            ->add(new Rule\NonTerminalRule(
                'Annotation',
                new Body\SequenceBody([
                    new Body\RuleBody('AT'),
                    new Body\RuleBody('AnnotationName'),
                    new Body\RuleBody('MethodCall'),
                ])
            ))
            ->add(new Rule\NonTerminalRule(
                'AnnotationName',
                new Body\RuleBody('IDENTIFIER')
            ))
            ->add(new Rule\NonTerminalRule(
                'MethodCall',
                new Body\OptionalBody(
                    new Body\SequenceBody([
                        new Rule\RuleSet('OPEN_PARENTHESIS'),
                        new Body\RuleBody('MethodArguments'),
                        new Body\RuleBody('CLOSE_PARENTHESIS'),
                    ])
                )
            ))
            ->add(new Rule\NonTerminalRule(
                'MethodArguments',
                new Body\AlternateBody([
                    new Body\EmptyBody(),
                    new Body\RuleBody('IDENTIFIER'), // @todo finish this
                ])
            ))
        ;

        $this->grammar = new Grammar\RegularGrammar($ruleSet);
    }
}