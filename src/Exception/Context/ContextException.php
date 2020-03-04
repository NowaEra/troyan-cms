<?php
declare(strict_types=1);

namespace App\Exception\Context;

use App\Exception\CmsException;

/**
 * Class ContextException
 * Package App\Exception\Context
 */
class ContextException extends CmsException
{
    public static function createForUnresolvedContextForHost(string $host, int $code = 0, \Throwable $previous = null): ContextException
    {
        return new ContextException(
            sprintf('Unable to match context for current host "%s".', $host),
            $code,
            $previous
        );
    }
}
