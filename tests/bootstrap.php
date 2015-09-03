<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a full copyright notice, see the LICENSE file.
 */

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
spl_autoload_register(function($class)
{
    if (0 === strpos($class, 'Opensoft\Bundle\UpsShipmentBundle\Tests\\')) {
        $path = __DIR__.'/../tests/'.strtr($class, '\\', '/').'.php';
        if (file_exists($path) && is_readable($path)) {
            require_once $path;

            return true;
        }
    } else if (0 === strpos($class, 'Opensoft\Bundle\UpsShipmentBundle\\')) {
        $path = __DIR__.'/../src/'.($class = strtr($class, '\\', '/')).'.php';
        if (file_exists($path) && is_readable($path)) {
            require_once $path;

            return true;
        }
    }
});

