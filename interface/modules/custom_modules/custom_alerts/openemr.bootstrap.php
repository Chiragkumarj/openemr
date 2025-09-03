<?php

namespace OpenEMR\Modules\CustomAlerts;

/**
 * @global OpenEMR\Core\ModulesClassLoader $classLoader
 * @global EventDispatcher $eventDispatcher
 */
$classLoader->registerNamespaceIfNotExists(
    'OpenEMR\\Modules\\CustomAlerts\\',
    __DIR__ . DIRECTORY_SEPARATOR . 'src'
);

$bootstrap = new Bootstrap($eventDispatcher, $GLOBALS['kernel']);
$bootstrap->subscribeToEvents();
