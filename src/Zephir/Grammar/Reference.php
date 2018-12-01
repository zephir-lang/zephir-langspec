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

use Zephir\Exceptions\UnknownReferenceException;

final class Reference implements Renderable
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param  RenderContext $context
     * @return string
     * @throws UnknownReferenceException
     */
    public function render(RenderContext $context): string
    {
        if (!isset($context[$this->name])) {
            throw new UnknownReferenceException($this->name);
        }

        $fileName = $context[$this->name];
        $anchor = "#grammar-{$this->name}";

        if ($fileName != $context->getCurrentFile()) {
            $anchor .= $fileName;
        }

        return "<i><a href=\"{$anchor}\">{$this->name}</a></i>";
    }
}
