<?php
declare(strict_types=1);

namespace SiteContextBundle\DependencyInjection;

use SiteContextBundle\Entity\BaseContext;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * Class Configuration
 * @package SiteContextBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{

    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('cms_context');
        $treeBuilder->getRootNode()
            ->isRequired()
            ->children()
                ->arrayNode('configuration')
                    ->isRequired()
                    ->children()
                        ->scalarNode('context_class')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->validate()
                                ->always(function($value){
                                    if(false === is_subclass_of($value, BaseContext::class, true)){
                                        throw new InvalidConfigurationException(
                                            sprintf('"site_context.configuration.context_class" is expected to hold FQN of "%s" instance, is your class extending one?', BaseContext::class)
                                        );
                                    }
                                    return $value;
                                })
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
