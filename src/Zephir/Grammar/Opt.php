<?php declare(strict_types=1);

namespace Zephir\Grammar;

final class Opt implements Renderable
{
    /** @var Renderable */
    private $inner;

    public function __construct(Renderable $inner)
    {
        $this->inner = $inner;
    }

    public function render(RenderContext $context): string
    {
        return $this->inner->render($context) . '<sub>opt</sub>';
    }
}
