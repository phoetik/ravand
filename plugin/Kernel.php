<?php

namespace Ravand;

use Pluguin\Foundation\Plugin as BasePlugin;
use Pluguin\Database\Database;
use Ravand\Database\Migrations;

class Plugin extends BasePlugin
{
    public function install()
    {
        $this["migrator"]();
    }

    public function activate()
    {
        //
    }

    public function deactivate()
    {
        //
    }

    public function uninstall()
    {
        $this->resetMigrations();
    }

    public function upgrade($from, $to)
    {
        Migrator::run(Migrations::class);
    }

    public function downgrade($from, $to)
    {
        Migrator::rollback(Migrations::class);
    }
}