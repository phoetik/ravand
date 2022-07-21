<?php

namespace Ravand;

use Pluguin\Pluguin;

final class Bootstrapper
{
    private static $pluginFile;

    public static function run($pluginFile)
    {
        self::setPluginFile($pluginFile);

        if (get_option("pluguin") !== false) {
            self::register();
        } else {
            self::rejectHooks();
        }
    }

    public static function setPluginFile($pluginFile)
    {
        self::$pluginFile = $pluginFile;
    }

    public static function getPluginFile()
    {
        return self::$pluginFile;
    }

    public static function register()
    {
        if (class_exists(Pluguin::class)) {
            Pluguin::register(
                self::bootstrap()
            );
        } else {
            add_action("pluguin", function ($pluguin) {
                $pluguin::register(
                    self::bootstrap()
                );
            });
        }
    }

    private static function rejectHooks()
    {
        register_activation_hook(self::class."::reject_activate");
        register_deactivation_hook(self::class."::reject_deactivate");
        register_uninstall_hook(self::class."::reject_uninstall");
    }

    private static function bootstrap()
    {
        $plugin = new Plugin(
            self::getPluginFile()
        );

        return $plugin;
    }

    // public static function activate()
    // {
    //     self::reject("activate");
    // }

    // public static function deactivate()
    // {
    //     self::reject("deactivate");
    // }

    // public static function uninstall()
    // {
    //     self::reject("uninstall");
    // }

    private static function reject($action)
    {
        
    }

    public static function __callStatic($name, $args)
    {
        $words = explode("_", $name, 2);

        if($words[0] == "reject" && count($words) == 2) {
            if(in_array($words[1], [
                "activate",
                "deactivate",
                "uninstall"
            ])) {
                $action = $words[1];
                $adminPluginsUrl = \admin_url('plugins.php');
                wp_die("In order to $action this plugin you need to install and activate Pluguin. <br><br><a href='$adminPluginsUrl'>Return back to plugins.</a>");
            }
        }
    }
}
