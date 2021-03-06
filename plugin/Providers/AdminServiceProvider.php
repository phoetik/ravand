<?php

namespace Ravand\Providers;

use Pluguin\Support\ServiceProvider;
use Ravand\Services\AdminService;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        $this->plugin->singleton('admin', function($plugin){
            return new AdminService($plugin);
        });
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        $this->plugin["admin"]->registerActions();
    }
}