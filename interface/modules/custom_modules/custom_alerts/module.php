<?php

// Required by OpenEMR
namespace OpenEMR\Modules\CustomAlerts;

class Module
{
    public function __construct()
    {
        // Module init if needed
    }

    public function install()
    {
        // Run when installing
        return true;
    }

    public function uninstall()
    {
        // Run when uninstalling
        return true;
    }
}
