<?php

namespace Ravand;

use Pluguin\Foundation\Plugin as BasePlugin;
use Pluguin\Database\Database;
use Ravand\Database\Migrations;

class Plugin extends BasePlugin
{
    public function init()
    {
        add_filter('theme_page_templates', function ($templates) {
            $templates[ $this->panelTemplatePath() ] = "Ravand Admin Template";
        
            return $templates;
        });

        wp_enqueue_script("jquery-ui-sortable");

        add_filter( 'template_include', function ($template) {
            if (is_page()) {
                $meta = get_post_meta(get_the_ID());
        
                if (!empty($meta['_wp_page_template'][0]) && $meta['_wp_page_template'][0] != $template) {
                    $template = $meta['_wp_page_template'][0] = $this->panelTemplatePath();
                }
            }
        
            return $template;
        }, 99 );
    }
    
    public function install()
    {
        // $this->migrate();
    }

    public function activate()
    {
        // $this->cacheConfiguration();
        $this->createMigrationRepository();
        $this->migrate();
    }

    public function deactivate()
    {
        
        $this->resetMigrations();
        $this->deleteMigrationRepository();
        // $this->clearConfigurationCache();
    }

    public function uninstall()
    {
    }

    public function upgrade($from, $to)
    {
        //
    }

    public function downgrade($from, $to)
    {
        //
    }

    private function panelTemplatePath()
    {
        return $this->resourcePath("templates/panel.php");
    }

    private function migrate()
    {
        $this["migrator"]->run([
            $this->databasePath().'/migrations/'
        ]);
    }

    private function createMigrationRepository()
    {
        if (!$this["migration.repository"]->repositoryExists()) {
            $this["migration.repository"]->createRepository();
        }
    }

    private function resetMigrations()
    {
        $this["migrator"]->reset([
            $this->databasePath().'/migrations/'
        ]);
    }

    private function deleteMigrationRepository()
    {
        if ($this["migration.repository"]->repositoryExists()) {
            $this["migration.repository"]->deleteRepository();
        }
    }
}
