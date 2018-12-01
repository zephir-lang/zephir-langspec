<?php declare(strict_types=1);

namespace Zephir\Exceptions;

use Throwable;

final class DuplicateDefinitionException extends \LogicException
{
    public function __construct(string $name, int $code = 0, Throwable $previous = null)
    {
        $message = "Duplicate definition for '{$name}'";

        parent::__construct($message, $code, $previous);
    }
}
