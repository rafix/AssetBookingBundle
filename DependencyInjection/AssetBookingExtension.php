<?php

namespace Application\AssetBookingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AssetBookingExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {    $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
        $loader->load('services.xml');
      
     
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/asset_booking';
    }

    public function getAlias()
    {
        return 'asset_booking';
    }
}