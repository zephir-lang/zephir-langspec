<?php

/*
 * This file is part of the Zephir Language Specifications.
 *
 * (c) Zephir Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Zephir\Spec;

use DirectoryIterator;

final class Files
{
    /** @var string */
    private $specDir;

    public function __construct(string $specDir)
    {
        $this->specDir = $specDir;
    }

    public function __invoke(array $skipFiles = [])
    {
        $dir = new DirectoryIterator($this->specDir);

        foreach ($dir as $fileInfo) {
            if ($fileInfo->isDot() || $fileInfo->isDir()) {
                continue;
            }

            if ($fileInfo->getExtension() != 'md') {
                continue;
            }

            if ($fileInfo->getBasename() == '00-specification-for-zephir.md' ||
                in_array($fileInfo->getBasename(), $skipFiles)
            ) {
                continue;
            }

            yield $fileInfo->getBasename() => $fileInfo->getRealPath();
        }
    }
}
