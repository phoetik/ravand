<?php

namespace Ravand;

use Pluguin\Foundation\Plugin as BasePlugin;
use Pluguin\Database\Database;
use Ravand\Database\Migrations;

class Plugin extends BasePlugin
{
    public $version = "0.0.2"; 

    public function activate()
    {
        
    }

    public function install()
    {
        Migrator::run(Migrations::class);
    }

    public function uninstall()
    {
        Migrator::reset(Migrations::class);
    }

    public function deactivate()
    {
        
    }

    public function upgrade()
    {
        Migrator::run(Migrations::class);
    }

    public function downgrade()
    {
        Migrator::rollback(Migrations::class);
    }
}