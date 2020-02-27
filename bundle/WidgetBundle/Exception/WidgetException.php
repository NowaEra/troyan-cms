<?php
declare(strict_types=1);

namespace WidgetBundle\Exception;

use WidgetBundle\DependencyInjection\Compiler\WidgetCompilerPass;

/**
 * Class WidgetException
 * Package WidgetBundle\Exception
 */
class WidgetException extends \RuntimeException
{
    public static function createForWidgetNotFound(string $id, int $code = 0, \Throwable $previous = null): WidgetException
    {
        return new WidgetException(
            sprintf(
                'Widget with id "%s" was not found, did you forget to tag your service with "%s" tag?',
                $id,
                WidgetCompilerPass::SERVICES_TAG
            ),
            $code,
            $previous
        );
    }

    public static function throwForUnsupportedInput(int $code = 0, \Throwable $previous = null): WidgetException{
        return new WidgetException(
            'Unable to determine how to obtain widget from provided data',
            $code,
            $previous
        );
    }
}
