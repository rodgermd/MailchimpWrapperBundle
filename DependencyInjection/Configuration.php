<?php

namespace Rodgermd\MailchimpWrapperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * Defines configuration
 *
 * @package Rodgermd\MailchimpWrapperBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('rodgermd_mailchimp_wrapper');

        $rootNode
          ->children()
            ->scalarNode('api_key')->isRequired()->end()
            ->scalarNode('default_list_id')->isRequired()->end()
          ->end();

        return $treeBuilder;
    }
}
