<?php

namespace OpenEMR\Modules\CustomAlerts;

/**
 * @global OpenEMR\Core\ModulesClassLoader $classLoader
 * @global EventDispatcher $eventDispatcher
 */

// Register namespace for future event-based features
$classLoader->registerNamespaceIfNotExists(
    'OpenEMR\\Modules\\CustomAlerts\\',
    __DIR__ . DIRECTORY_SEPARATOR . 'src'
);

// Include hooks to guarantee legacy functionality
require_once __DIR__ . '/hooks.php';

// Optional: keep event dispatcher for future events
// $bootstrap = new Bootstrap($eventDispatcher, $GLOBALS['kernel']);
// $bootstrap->subscribeToEvents();
