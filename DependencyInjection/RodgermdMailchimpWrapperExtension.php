<?php

namespace Rodgermd\MailchimpWrapperBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

/**
 * Class RodgermdMailchimpWrapperExtension
 * Defines extensions
 *
 * @package Rodgermd\MailchimpWrapperBundle\DependencyInjection
 */
class RodgermdMailchimpWrapperExtension extends Extension
{
    /**
     * Load configuration
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        foreach (array('services') as $basename) {
            $loader->load(sprintf('%s.yml', $basename));
        }

        $config = $configs[0];
        foreach ($config as $key => $value) {
            $container->setParameter('rodgermd.mailchimp.' . $key, $value);
        }
    }
}
