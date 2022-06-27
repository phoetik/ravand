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

add_action('admin_init', function () {
    if (is_admin() && current_user_can('activate_plugins') && !defined("PLUGUIN")) {
        add_action('admin_notices', function () {
            echo '<div class="error"><p>Ravand requires Pluguin to be installed and active.</p></div>';
        });
    }
});

add_action("pluguin", function ($pluguin) {

    require_once __DIR__ . '/vendor/autoload.php';

    $ravand = require_once __DIR__ . "/bootstrap/plugin.php";


});


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
