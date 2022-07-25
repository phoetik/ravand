<?php

namespace Ravand\Providers;

use Pluguin\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider
{
    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        if(\is_admin()) {
            $this->plugin["events"]->dispatch("wp-admin-request");
        }
    }
}