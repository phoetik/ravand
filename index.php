<?php

/**
 * Ravand Admin Panel
 *
 * @package     Ravand Admin Panel
 * @author      sina-radmanesh
 * @copyright   2022 Webbax
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Pluguin
 * Plugin URI: https://webbax.dev/pluguin
 * Description: Advanced mvc plugins using composer and eloquent
 * Version:     0.1.0
 * Requires PHP: 7.4
 * Author:      Sina Radmanesh
 * Author URI:  http://webbax.dev
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined('ABSPATH') or die('Not Authorized!');

/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
|
|
 */

if (defined('RAVAND')) {
    return;
}

define("RAVAND", true);

add_action("pluguin", function ($pluguin) {

    require __DIR__ . '/vendor/autoload.php';

    /*
    |--------------------------------------------------------------------------
    | Create The plugin
    |--------------------------------------------------------------------------
    |
    | we will create a new plugin instance and register it
    |
     */

    $bootstrapper = require_once __DIR__ . "/bootstrap/plugin.php";

    $plugin = $bootstrapper(__FILE__);

    $pluguin->register($plugin);

    // $plugin->singleton(
    //     Pluguin\Contracts\Wordpress\Kernel::class,
    //     Ravand\Wordpress\Kernel::class
    // );

});

add_action("plugins_loaded", function(){
    if(!defined("PLUGUIN")){
        register_activation_hook( __FILE__, function(){
            add_action( 'admin_init', function(){
                if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
                    deactivate_plugins( plugin_basename( __FILE__ ) );
                    add_action( 'admin_notices', function() {
                        echo '<strong>' . esc_html__( 'My Plugin requires WordPress 3.7 or higher!', 'my-plugin' ) . '</strong>';
                    });
                    if ( isset( $_GET['activate'] ) ) {
                        unset( $_GET['activate'] );
                    }
                }
            });
        });
    }
});
    
//  In this example, only allow activation on WordPress 3.7 or higher
class MyPlugin {
    function __construct() {
        add_action( 'admin_init', array( $this, 'check_version' ) );

        // Don't run anything else in the plugin, if we're on an incompatible WordPress version
        if ( ! self::compatible_version() ) {
            return;
        }
    }

    // The primary sanity check, automatically disable the plugin on activation if it doesn't
    // meet minimum requirements.
    static function activation_check() {
        if ( ! self::compatible_version() ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( __( 'My Plugin requires WordPress 3.7 or higher!', 'my-plugin' ) );
        }
    }

    // The backup sanity check, in case the plugin is activated in a weird way,
    // or the versions change after activation.
    function check_version() {
        if ( ! self::compatible_version() ) {
            
        }
    }

    function disabled_notice() {
       echo '<strong>' . esc_html__( 'My Plugin requires WordPress 3.7 or higher!', 'my-plugin' ) . '</strong>';
    }

    static function compatible_version() {
        if ( version_compare( $GLOBALS['wp_version'], '3.7', '<' ) ) {
            return false;
        }

        // Add sanity checks for other version requirements here

        return true;
    }
}

global $myplugin;
$myplugin = new MyPlugin();

register_activation_hook( __FILE__, array( 'MyPlugin', 'activation_check' ) );


/*

Main actions during rest api request:

plugins_loaded
init
wp_loaded
rest_api_init
shutdown

Main actions during a dashboard request:

plugins_loaded
init
wp_loaded
admin_init
shutdown

Main actions during a typical request:

plugins_loaded
init
wp_loaded
shutdown

Main actions during an uninstallation request

check for WP_UNINSTALL_PLUGIN and is_plugin_active( 'wordpress-seo/wp-seo.php' )

plugins_loaded
init
wp_loaded
admin_init
pre_uninstall_plugin
uninstall_rava.php
delete_plugin
deleted_plugin
shutdown

 */

// add_action('admin_init', function () {
//     if (is_admin() && current_user_can('activate_plugins') && !defined("PLUGUIN")) {
//         add_action('admin_notices', function () {
//             echo '<div class="error"><p>Ravand requires Pluguin to be installed and active.</p></div>';
//         });
//     }
// });