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

final class Plain implements Renderable
{
    /**
     * @var string
     */
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
