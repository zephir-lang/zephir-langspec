<?php declare(strict_types=1);

/*
 * This file is part of the Zephir Language Specifications.
 *
 * (c) Zephir Team <team@zephir-lang.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
