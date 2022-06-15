<?php

use Ravand\Core\Database;
use Ravand\Core\Router\AdminRouter;
use Ravand\Core\Traits\Singleton;
use Illuminate\Database\Capsule\Manager as Capsule;

class RavandAdmin
{
    use Singleton;

    public $plugin;
    public $router;

    private function __construct()
    {
        $this->plugin = Ravand::getInstance();

        $this->router = \Ravand\Core\Router\AdminRouter::init();

        $this->router->loadRoutes("admin");
    }
    
};
