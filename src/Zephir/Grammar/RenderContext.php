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

final class RenderContext extends \ArrayObject
{
    /**
     * @var string
     */
    private $currentFile;

    public function __construct(array $names, string $currentFile)
    {
        $this->currentFile = $currentFile;

        parent::__construct($names);
    }

    public function getCurrentFile(): string
    {
        return $this->currentFile;
    }
}
