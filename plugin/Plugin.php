<?php

namespace Ravand;

use Pluguin\Foundation\Plugin as BasePlugin;
use Pluguin\Database\Database;
use Ravand\Database\Migrations;

class Plugin extends BasePlugin
{
    public function init()
    {

    }
    
    public function install()
    {
        // $this->migrate();
    }

    public function activate()
    {
        // $this->cacheConfiguration();
    }

    public function deactivate()
    {
        // $this->clearConfigurationCache();
    }

    public function uninstall()
    {
        // $this->resetMigrations();
    }

    public function upgrade($from, $to)
    {
        // 
    }

    public function downgrade($from, $to)
    {
        // 
    }
}