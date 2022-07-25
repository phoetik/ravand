<?php

namespace Ravand\Bootstrap;

use Pluguin\Pluguin;
use Ravand\Bootstrap\Factory as PluginFactory;

class Hooks
{
    private static $factory;

    public static function setup(PluginFactory $factory)
    {
        self::setPluginFactory($factory);

        self::register(
            self::pluguinExists()
        );
    }

    public static function setPluginFactory(PluginFactory $factory)
    {
        self::$factory = $factory;
    }

    public static function getPluginFactory()
    {
        return self::$factory;
    }

    private static function pluguinExists()
    {
        return \get_option("pluguin") !== false;
    }

    public static function register($allow = true)
    {
        $prefix = "reject";

        if ($allow) {
            $prefix = "register";
            self::deferredPluguinCall("register", self::getPluginFactory());
        }

        $file = self::getPluginFactory()->getPluginFile();

        $class = self::class;

        register_activation_hook($file, "$class::$prefix-activate");
        register_deactivation_hook($file, "$class::$prefix-deactivate");
        register_uninstall_hook($file, "$class::$prefix-uninstall");
    }

    public static function __callStatic($name, $args)
    {
        $words = explode("-", $name, 2);

        if (count($words) !== 2) {
            return;
        }

        if (!in_array($words[1], [
            "activate",
            "deactivate",
            "uninstall"
        ])) {
            return;
        }

        $prefix = $words[0];
        $hook = $words[1];

        if ($prefix == "register") {
            self::deferredPluguinCall(
                $hook,
                self::getPluginFactory()
            );
        } elseif ($prefix == "reject") {
            $adminPluginsUrl = \admin_url('plugins.php');
            wp_die("In order to $hook this plugin you need to install and activate Pluguin. <br><br><a href='$adminPluginsUrl'>Return back to plugins.</a>");
        }
    }

    
    private static function deferredPluguinCall($method, callable $argumentProvider)
    {
        if (class_exists(Pluguin::class)) {
            $args = self::getArguments($argumentProvider);
            Pluguin::getInstance()
                ->{$method}(...$args);
        } else {
            add_action("pluguin", function ($pluguin) use ($method, $static, $args) {
                $args = self::getArguments($argumentProvider);
                $pluguin->{$method}(...$args);
            });
        }
    }

    private static function getArguments(callable $argumentProvider)
    {
        $args = $argumentProvider();
        return is_array($args) ? $args : [$args];
    }
}
