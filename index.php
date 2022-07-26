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

 
$wporg_page = "wporg_page";
$wporg_group = "wporg_group";
$wporg_options ="wporg_options";
$wporg_section ="wporg_section";

add_action("admin_init", function() use ($wporg_group, $wporg_page, $wporg_options, $wporg_section){

    register_setting( 
        $wporg_page, // page
        $wporg_options // option name
    );

    $sectionCallback = function ( $args ) use ($wporg_group, $wporg_page, $wporg_options, $wporg_section) {
        $id = $args['id'];
        $text = 'Follow the white rabbit.';

        echo "<p id='$id'>$text</p>";
    };

    add_settings_section(
        $wporg_section, // id
        __( 'The Matrix has you.', 'wporg' ),  // title
        $sectionCallback, // callback
        $wporg_page // page 
    );

    $fieldCallback = function ( $args ) use ($wporg_group, $wporg_page, $wporg_options, $wporg_section) {
        // Get the value of the setting we've registered with register_setting()
        $options = get_option('wporg_options');

        $id = $args['label_for'];
        $customData = $args['wporg_custom_data'];

        echo "<select
                    id='$id'
                    data-custom='$customData'
                    name='wporg_options[$id]'>
                        <option value='red' ".(isset($options[ $args['label_for'] ]) ? (selected($options[ $args['label_for'] ], 'red', false)) : ('')).">
                            red pill
                        </option>
                        <option value='blue' ".(isset($options[ $args['label_for'] ]) ? (selected($options[ $args['label_for'] ], 'blue', false)) : ('')).">
                            blue pill
                        </option>
                </select>
                <p class='description'>
                    You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.
                </p>
                <p class='description'>
                    You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.
                </p>";
    };

    add_settings_field(
        'wporg_field_pill', // id 
        'Pill', // title (outputed)
        $fieldCallback,
        $wporg_page, // page,
        $wporg_section, // section id
        array(
            'label_for'         => 'wporg_field_pill',
            'class'             => 'wporg_row',
            'wporg_custom_data' => 'custom',
        )
    );

    

});



add_action( 'admin_menu', function() use ($wporg_group, $wporg_page, $wporg_options, $wporg_section) {

    $menuCallback = function() use ($wporg_group, $wporg_page, $wporg_options, $wporg_section) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
     
        // add error/update messages
     
        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if ( isset( $_GET['settings-updated'] ) ) {
            // add settings saved message with the class of "updated"
            add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
        }
     
        // show error/update messages
        settings_errors( 'wporg_messages' );
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "wporg"
                settings_fields( $wporg_page );
                // output setting sections and their fields
                // (sections are registered for "wporg", each field is registered to a specific section)
                do_settings_sections( $wporg_page );
                // output save settings button
                submit_button( 'Save Settings' );
                ?>
            </form>
        </div>
        <?php
    };

    add_menu_page(
        'WPOrg', // title
        'WPOrg Options', // Menu Title
        'manage_options', // Capability
        $wporg_page, // menu slug (page?)
        $menuCallback
    );
} );