<?php

/**
 * Ravand Admin Panel
 *
 * @package     Ravand Admin Panel
 * @author      sina-radmanesh
 * @copyright   2022 RavandSoft
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Ravand Admin Panel
 * Plugin URI: https://ravandsoft.com/admin-panel
 * Description: ...
 * Version:     0.0.1
 * Requires PHP: 7.4
 * Author:      Sina Radmanesh
 * Author URI:  http://webbax.ir
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: ravand
 * Domain Path: /resources/lang
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
file_put_contents(ABSPATH."/ravand_aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.txt","");

function ravand_uninstalll()
{
    file_put_contents(ABSPATH."/ravand_uninstalllddddddddddddddddddddddddddddddddddddddddddddddd.txt","");
}
register_uninstall_hook( __FILE__,  'ravand_uninstalll');

// register_uninstall_hook( __FILE__,  function(){
//     do_action("test_uninstall");
// });

// if (!defined('RAVAND')) {
//     require_once __DIR__ . '/../vendor/autoload.php';

//     require_once __DIR__ . "/bootstrap/plugin.php";
// }

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



*/
