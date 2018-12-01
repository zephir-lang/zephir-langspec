<?php declare(strict_types=1);

namespace Zephir\Grammar;

use Zephir\Exceptions\InvalidDefinitionException;
use Zephir\Exceptions\NoHeadingFoundException;

/**
 * @param  string $code
 * @return Definition[]
 * @throws InvalidDefinitionException
 */
function get_all_defs(string $code): array
{
    if (!preg_match_all('/<!--\s*GRAMMAR(.*?)-->/s', $code, $matches)) {
        return [];
    }

    $defs = [];

    foreach ($matches[1] as $grammar) {
        $defs = array_merge($defs, parse_grammar($grammar));
    }

    return $defs;
}

/**
 * @param  string $grammar
 * @return Definition[]
 * @throws InvalidDefinitionException
 */
function parse_grammar(string $grammar): array
{
    $defs = [];
    $defTexts = explode("\n\n", trim($grammar));

    foreach ($defTexts as $defText) {
        if (!preg_match('/^([a-zA-Z0-9-]+)(::?)(\s+one\s+of)?\n(.*?)$/s', $defText, $matches)) {
            throw new InvalidDefinitionException($defText);
        }

        $rules = array_map('Zephir\Grammar\parse_rule', explode("\n", $matches[4]));
        $defs[] = new Definition(
            $matches[1], $matches[2] === '::', $matches[3] !== '', $rules
        );
    }

    return $defs;
}


function parse_rule($rule): Rule
{
    $regex = <<<'REGEX'
/(?:
    '[^']*(?:''[^']*)*'
  | "[^"]*(?:""[^"]*)*"
)(*SKIP)(*FAIL)|\s+/x
REGEX;

    $parts = array_map('Zephir\Grammar\parse_rule_part', preg_split($regex, trim($rule)));

    return new Rule($parts);
}

function parse_rule_part(string $part): Renderable
{
    if (substr($part, -1) === '?') {
        return new Opt(parse_rule_part(substr($part, 0, -1)));
    }

    if (empty($part)) {
        return new Plain('');
    }

    if ($part[0] === "'") {
        $contents = str_replace("''", "'", substr($part, 1, -1));
        return new Plain($contents);
    }

    if ($part[0] === '"') {
        $contents = str_replace('""', '"', substr($part, 1, -1));
        return new Plain($contents);
    }

    return new Reference($part);
}

/**
 * Render grammar.
 *
 * @param  Renderable[] $definitions
 * @param  array        $names
 * @param  string       $currentFile
 * @return string
 */
function render_grammar(array $definitions, array $names, string $currentFile): string
{
    $context = new RenderContext($names, $currentFile);

    $result = [];
    foreach ($definitions as $definition) {
        $result[] = $definition->render($context);
    }

    return "<pre>\n" . implode("\n\n", $result) . "\n</pre>";
}

/**
 * @param  string $code
 * @param  array $names
 * @return string|null
 * @throws InvalidDefinitionException
 */
function extract_grammar(string $code, array $names): ?string
{
    $defs = get_all_defs($code);

    if (empty($defs)) {
        return null;
    }

    return render_grammar($defs, $names, '19-grammar.md');
}

/**
 * @param  string $code
 * @param  string $filename
 * @return string
 * @throws NoHeadingFoundException
 */
function extract_heading(string $code, string $filename): string
{
    if (!preg_match('/#\s*(.*)/', $code, $matches)) {
        throw new NoHeadingFoundException($filename);
    }

    return $matches[1];
}
