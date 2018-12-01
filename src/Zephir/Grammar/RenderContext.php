<?php declare(strict_types=1);

namespace Zephir\Grammar;

final class RenderContext extends \ArrayObject
{
    /** @var string */
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
