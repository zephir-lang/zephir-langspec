<?php declare(strict_types=1);

namespace Zephir\Exceptions;

use Throwable;

final class InvalidDefinitionException extends \LogicException
{
    public function __construct(string $definition, int $code = 0, Throwable $previous = null)
    {
        $message = "Invalid definition '{$definition}'";

        parent::__construct($message, $code, $previous);
    }
}
