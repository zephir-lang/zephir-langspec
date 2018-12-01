<?php declare(strict_types=1);

namespace Zephir\Grammar;

final class Plain implements Renderable
{
    /** @var string */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function render(RenderContext $context): string
    {
        return htmlspecialchars($this->text);
    }
}
