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
 * Plugin Name: Ravand
 * Plugin URI: https://webbax.dev/ravand
 * Description: Awesome interactive user panel for Wordpress
 * Version:     0.1.0
 * Requires PHP: 7.4
 * Author:      Sina Radmanesh
 * Author URI:  http://webbax.dev
 * Text Domain: ravand
 * Domain Path: /resources/lang
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined('ABSPATH') or die('Not Authorized!');

define('RAVAND', true);

use Ravand\Bootstrap\Hooks;
use Ravand\Bootstrap\Factory;

/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
|
|
 */

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . "/bootstrap/hooks.php";

require_once __DIR__ . "/bootstrap/factory.php";

Hooks::setup(
    new Factory(__FILE__)
);

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
// return;
 