<?php
declare(strict_types=1);

namespace WidgetBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use WidgetBundle\DependencyInjection\Compiler\WidgetCompilerPass;

/**
 * Class WidgetBundle
 * Package WidgetBundle
 */
class WidgetBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new WidgetCompilerPass());
    }
}
