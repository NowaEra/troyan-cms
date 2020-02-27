<?php

namespace WidgetBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class WidgetCompilerPass implements CompilerPassInterface
{
    const SERVICES_TAG          = 'cms.widget';
    const REPOSITORY_SERVICE_ID = 'cms.widget.repository';

    public function process(ContainerBuilder $container)
    {
        if (false === $container->has(self::REPOSITORY_SERVICE_ID)) {
            return;
        }

        $repositoryDefinition = $container->getDefinition(self::REPOSITORY_SERVICE_ID);
        $taggedService        = $container->findTaggedServiceIds(
            self::SERVICES_TAG
        );

        foreach ($taggedService as $id => $tag) {
            $repositoryDefinition->addMethodCall('registerWidget', [$id, new Reference($id)]);
        }
    }
}
