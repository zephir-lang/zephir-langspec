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

final class Opt implements Renderable
{
    /**
     * @var Renderable
     */
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
