<?php

namespace Ravand;

use Pluguin\Foundation\Plugin;
use Pluguin\Database\Database;
use Ravand\Database\Migrations;

class Kernel extends Plugin
{
    public function install()
    {
        $this->migrate();
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