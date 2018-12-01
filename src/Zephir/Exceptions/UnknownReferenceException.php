<?php declare(strict_types=1);

namespace Zephir\Exceptions;

use Throwable;

final class UnknownReferenceException extends \LogicException
{
    public function __construct(string $name, int $code = 0, Throwable $previous = null)
    {
        $message = "Reference to unknown name '{$name}'";

        parent::__construct($message, $code, $previous);
    }
}
