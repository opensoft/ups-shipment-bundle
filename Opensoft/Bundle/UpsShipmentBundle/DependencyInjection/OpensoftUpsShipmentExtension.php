<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a full copyright notice, see the LICENSE file.
 */

namespace Opensoft\Bundle\UpsShipmentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OpensoftUpsShipmentExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('opensoft_ups_shipment.credentials.ups_access_key', $config['credentials']['ups_access_key']);
        $container->setParameter('opensoft_ups_shipment.credentials.ups_username', $config['credentials']['ups_username']);
        $container->setParameter('opensoft_ups_shipment.credentials.ups_password', $config['credentials']['ups_password']);
        $container->setParameter('opensoft_ups_shipment.credentials.ups_production_mode', $config['credentials']['ups_production_mode']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}
