<?php

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
