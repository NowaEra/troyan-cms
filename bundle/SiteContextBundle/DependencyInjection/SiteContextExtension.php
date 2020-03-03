<?php
declare(strict_types=1);

namespace SiteContextBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class SiteContextExtension
 * Package SiteContextBundle\DependencyInjection
 */
class SiteContextExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $configuration = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yaml');
        $this->registerRepository($configuration['configuration'], $container);
    }

    private function registerRepository(array $configuration, ContainerBuilder $builder): void
    {
        $builder->setParameter(
            'cms.site_context.entity.class',
            $configuration['context_class']
        );
        $definition = new Definition(
            $builder->getParameter('cms.site_context.repository.class'),
            [
                new Reference('doctrine'),
                $builder->getParameter('cms.site_context.entity.class')
            ]
        );
        $builder->setDefinition('cms.site_context.repository', $definition);
    }
}
