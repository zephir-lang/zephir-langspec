<?php declare(strict_types=1);

namespace Zephir\Grammar;

final class Rule implements Renderable
{
    /** @var Renderable[] */
    private $parts;

    public function __construct(array $parts)
    {
        $this->parts = $parts;
    }

    public function render(RenderContext $context): string
    {
        $parts = [];

        foreach ($this->parts as $part) {
            $parts[] = $part->render($context);
        }

        return implode('   ', $parts);
    }
}
