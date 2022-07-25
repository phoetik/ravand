<?php

namespace Ravand\Services;

use \Pluguin\Contracts\Foundation\Plugin;

class AdminService
{
    public $plugin;

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function registerActions()
    {
        add_action("admin_menu", function(){
            $this->addMenuPages();
        });
    }

    public function addMenuPages()
    {
        $slug = "ravand";
        $ravand_icon = 'data:image/svg+xml;base64,PHN2ZyBzdHlsZT0idHJhbnNmb3JtOnRyYW5zbGF0ZVkoLTJweCkiIHZlcnNpb249IjEuMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIg0KICAgIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDcwNC4wMDAwMDAgNjk4LjAwMDAwMCINCiAgICBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCBtZWV0Ij48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjAwMDAwMCw2OTguMDAwMDAwKSBzY2FsZSgwLjEwMDAwMCwtMC4xMDAwMDApIg0KICAgZmlsbD0iI2ZmZmZmZiIgc3Ryb2tlPSJub25lIj48cGF0aCBkPSJNMzM3MyA2MzMwIGMtOTggLTI2IC0yMiAxNiAtODgzIC00ODIgLTE5NSAtMTEzIC01MTcgLTI5OSAtNzE1IC00MTMNCiAgIC0xOTggLTExNCAtNDA3IC0yMzUgLTQ2NSAtMjY5IC0xODMgLTEwNiAtMjgyIC0yMjUgLTMzNyAtNDAyIC0xNyAtNTYgLTE4DQogICAtMTI0IC0xOCAtMTI4NCAwIC0xMzcxIC01IC0xMjc2IDcyIC0xNDI0IDYwIC0xMTUgMTQ4IC0xOTMgMzQ0IC0zMDUgOTAgLTUyDQogICAzMzUgLTE5NCA1NDQgLTMxNCAxNDc0IC04NTIgMTM1OCAtNzg3IDE0NTIgLTgxMSAzNyAtMTAgMTAyIC0xNiAxNjQgLTE2IDEzOQ0KICAgMCAyMTQgMjcgNDM0IDE1NSAyNjUgMTUzIDEzNzcgNzk1IDE2MDAgOTIzIDExMCA2MyAyMjUgMTMyIDI1NiAxNTMgMTI1IDg0DQogICAyMjQgMjI5IDI1NCAzNzQgMjIgMTA0IDIyIDI0MTUgMCAyNTIwIC0yMiAxMDcgLTgzIDIyMCAtMTU4IDI5NiAtNjYgNjcgLTEwMw0KICAgOTAgLTU0NyAzNDYgLTEyNCA3MiAtNDcwIDI3MiAtNzcwIDQ0NSAtNzY1IDQ0MiAtNzU3IDQzOCAtODI4IDQ3MSAtMTI0IDU4DQogICAtMjY4IDcxIC0zOTkgMzd6IG00ODEgLTE2NzAgYzMzNSAtMTkgNDcyIC02NCA2MDUgLTE5OSA0MyAtNDQgOTAgLTEwNCAxMDgNCiAgIC0xMzggbDMzIC02MSAtNjggLTcwIGMtMTAzIC0xMDUgLTIyNSAtMTgxIC0zODIgLTIzNiAtODUgLTMwIC0yNDYgLTY3IC0yNTQNCiAgIC01OCAtMyAzIC02IDI2IC02IDUxIDAgNTYgLTM3IDEzOSAtNzQgMTY5IC02MyA0OSAtMTE0IDU3IC0zNzEgNTcgbC0yNDAgMCAtMw0KICAgLTE1MSAtMyAtMTUxIC03MSAtNyBjLTEwNCAtMTEgLTIzOSAtNDcgLTQ2MyAtMTI2IC0xMDkgLTM4IC0yMDEgLTY3IC0yMDQgLTY0DQogICAtMyAzIC02IDIyNiAtNiA0OTQgbDAgNDg5IDUwIDQgYzExNyA4IDExODUgNiAxMzQ5IC0zeiBtNzcyIC04MzQgYy0zOSAtMTc1DQogICAtMTUzIC0zMjggLTMxNiAtNDI1IC0yNCAtMTQgLTg3IC00MCAtMTM4IC01NyBsLTk0IC0zMSA2OCAtMzIgYzk5IC00NiAxMzYNCiAgIC03NCAyMDIgLTE1NSAxMDMgLTEyNSAxMTAgLTEzNyAzNDYgLTU5NyA3NSAtMTQ2IDEzNiAtMjcxIDEzNiAtMjc4IDAgLTggLTEwNw0KICAgLTExIC00MjAgLTkgbC00MjEgMyAtMTA1IDE5NSBjLTU4IDEwNyAtMTU1IDI4NyAtMjE2IDQwMCAtMTQ1IDI3MCAtMTc2IDMxMg0KICAgLTI0OCAzNTAgLTM3IDE5IC0xMzMgNDAgLTE4MiA0MCBsLTI4IDAgLTIgLTQ5MiAtMyAtNDkzIC0zNzUgMCAtMzc1IDAgLTMgNTg3DQogICAtMiA1ODggNjIgMzIgYzE4NiA5NiAzMzEgMTUwIDUxNyAxOTUgMTAyIDI1IDEyMyAyNiA1MzEgMzMgNDYxIDggNDc2IDEwIDY3NQ0KICAgNzMgNTUgMTcgMTY4IDY1IDI1MCAxMDcgMTcxIDg2IDE2OCA4NyAxNDEgLTM0eiIvPjwvZz48L3N2Zz4=';
        add_menu_page(
            __("Ravand Admin Panel","ravand"),
            __("Ravand","ravand"),
            'manage_options',
            $slug,
            [$this, "renderMainAdminMenuPage"],
            $ravand_icon,
            // int $position = null
        );

        add_submenu_page(
            $slug,
            __("Ravand Appearance Settings","ravand"),
            __("Appearance", "ravand"),
            'manage_options',
            'ravand-appearance',
            [$this,"renderAppearanceSettings"]
        );
    }

    public function renderMainAdminMenuPage()
    {
        ?> Boo! <?php
    }

    public function renderAppearanceSettings()
    {
        register_setting( 'ravand-appearance', 'ravand-appearance-settings' );

        // Register a new section in the "wporg" page.
        add_settings_section(
            'ravand-title',
            __( 'Panel Title', 'ravand' ), 
            function ( $args ) {

                $id =  esc_attr( $args['id'] );
                $text = esc_html_e( "Something I don't know.", 'ravand' );

                echo "<p id='$id'>$text</p>";
            },
            'ravand-appearance'
        );

        add_settings_field(
            'ravand-panel-title',
            __( 'Toitle', 'ravand' ),
            function( $args ) {
                // Get the value of the setting we've registered with register_setting()
                $options = get_option( 'ravand-appearance-settings' );
                ?>
                <input type="text" value="<?php $options; ?>" name="<?php echo $args['label_for']?>">
                <p class="description">
                    <?php esc_html_e( 'Blah blah blah.', 'ravand' ); ?>
                </p>
                <?php
            },
            'ravand-appearance',
            'ravand-title',
            array(
                'label_for'         => 'ravand-field-title',
                // 'class'             => 'wporg_row',
                // 'wporg_custom_data' => 'custom',
            )
        );

        wp_enqueue_style( 'wp-color-picker' ); 
        require $this->plugin->resourcePath("views/admin/appearance.php");
    }
}