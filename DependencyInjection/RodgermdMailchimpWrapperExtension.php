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
  public function load(array $configs, ContainerBuilder $container)
  {
    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

    foreach (array('services') as $basename) {
      $loader->load(sprintf('%s.yml', $basename));
    }
  }
}
