<?php declare(strict_types=1);

namespace Zephir\Exceptions;

use Throwable;

final class NoHeadingFoundException extends \RuntimeException
{
    public function __construct(string $fileName, int $code = 0, Throwable $previous = null)
    {
        $message = "No heading found for file '{$fileName}'";

        parent::__construct($message, $code, $previous);
    }
}
