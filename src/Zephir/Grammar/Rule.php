<?php declare(strict_types=1);

/*
 * This file is part of the Zephir Language Specifications.
 *
 * (c) Zephir Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Zephir\Grammar;

final class Rule implements Renderable
{
    /**
     * @var Renderable[]
     */
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
