<?php

namespace OpenEMR\Modules\CustomAlerts;

/**
 * @global OpenEMR\Core\ModulesClassLoader $classLoader
 */

// Register namespace for future event-based features
$classLoader->registerNamespaceIfNotExists(
    'OpenEMR\\Modules\\CustomAlerts\\',
    __DIR__ . DIRECTORY_SEPARATOR . 'src'
);

// Include hooks to guarantee legacy functionality
require_once __DIR__ . '/hooks.php';

// Log subscription
error_log("✅ CustomAlerts module subscribed to hooks");
