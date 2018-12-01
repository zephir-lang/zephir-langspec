<?php declare(strict_types=1);

namespace Zephir\Grammar;

interface Renderable
{
    public function render(RenderContext $context): string;
}
