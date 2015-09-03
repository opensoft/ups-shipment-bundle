<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a full copyright notice, see the LICENSE file.
 */

namespace Opensoft\Bundle\UpsShipmentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('opensoft_ups_shipment');

        $rootNodeChildren = $rootNode->children();
        $userCredential = $rootNodeChildren->arrayNode('credentials');
        $userCredentialChildren = $userCredential->children();
        $userCredentialChildren->scalarNode('ups_access_key')->cannotBeEmpty()->isRequired()->end();
        $userCredentialChildren->scalarNode('ups_username')->cannotBeEmpty()->isRequired()->end();
        $userCredentialChildren->scalarNode('ups_password')->cannotBeEmpty()->isRequired()->end();
        $userCredentialChildren->scalarNode('ups_production_mode')->cannotBeEmpty()->isRequired()->end();
        $userCredentialChildren->end();
        $userCredential->end();
        $rootNodeChildren->end();

        return $treeBuilder;
    }
}
