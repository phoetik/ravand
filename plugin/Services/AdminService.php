<?php

namespace Ravand\Services;

use \Pluguin\Contracts\Foundation\Plugin;

class AdminService
{
    public $plugin;

    public $mainPageSlug = "ravand";

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function registerActions()
    {
        add_action("admin_menu", function () {
            $this->addMenuPages();
        });
    }

    public function addMenuPages()
    {
        $ravandIcon = 'data:image/svg+xml;base64,PHN2ZyBzdHlsZT0idHJhbnNmb3JtOnRyYW5zbGF0ZVkoLTJweCkiIHZlcnNpb249IjEuMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIg0KICAgIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDcwNC4wMDAwMDAgNjk4LjAwMDAwMCINCiAgICBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJ4TWlkWU1pZCBtZWV0Ij48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjAwMDAwMCw2OTguMDAwMDAwKSBzY2FsZSgwLjEwMDAwMCwtMC4xMDAwMDApIg0KICAgZmlsbD0iI2ZmZmZmZiIgc3Ryb2tlPSJub25lIj48cGF0aCBkPSJNMzM3MyA2MzMwIGMtOTggLTI2IC0yMiAxNiAtODgzIC00ODIgLTE5NSAtMTEzIC01MTcgLTI5OSAtNzE1IC00MTMNCiAgIC0xOTggLTExNCAtNDA3IC0yMzUgLTQ2NSAtMjY5IC0xODMgLTEwNiAtMjgyIC0yMjUgLTMzNyAtNDAyIC0xNyAtNTYgLTE4DQogICAtMTI0IC0xOCAtMTI4NCAwIC0xMzcxIC01IC0xMjc2IDcyIC0xNDI0IDYwIC0xMTUgMTQ4IC0xOTMgMzQ0IC0zMDUgOTAgLTUyDQogICAzMzUgLTE5NCA1NDQgLTMxNCAxNDc0IC04NTIgMTM1OCAtNzg3IDE0NTIgLTgxMSAzNyAtMTAgMTAyIC0xNiAxNjQgLTE2IDEzOQ0KICAgMCAyMTQgMjcgNDM0IDE1NSAyNjUgMTUzIDEzNzcgNzk1IDE2MDAgOTIzIDExMCA2MyAyMjUgMTMyIDI1NiAxNTMgMTI1IDg0DQogICAyMjQgMjI5IDI1NCAzNzQgMjIgMTA0IDIyIDI0MTUgMCAyNTIwIC0yMiAxMDcgLTgzIDIyMCAtMTU4IDI5NiAtNjYgNjcgLTEwMw0KICAgOTAgLTU0NyAzNDYgLTEyNCA3MiAtNDcwIDI3MiAtNzcwIDQ0NSAtNzY1IDQ0MiAtNzU3IDQzOCAtODI4IDQ3MSAtMTI0IDU4DQogICAtMjY4IDcxIC0zOTkgMzd6IG00ODEgLTE2NzAgYzMzNSAtMTkgNDcyIC02NCA2MDUgLTE5OSA0MyAtNDQgOTAgLTEwNCAxMDgNCiAgIC0xMzggbDMzIC02MSAtNjggLTcwIGMtMTAzIC0xMDUgLTIyNSAtMTgxIC0zODIgLTIzNiAtODUgLTMwIC0yNDYgLTY3IC0yNTQNCiAgIC01OCAtMyAzIC02IDI2IC02IDUxIDAgNTYgLTM3IDEzOSAtNzQgMTY5IC02MyA0OSAtMTE0IDU3IC0zNzEgNTcgbC0yNDAgMCAtMw0KICAgLTE1MSAtMyAtMTUxIC03MSAtNyBjLTEwNCAtMTEgLTIzOSAtNDcgLTQ2MyAtMTI2IC0xMDkgLTM4IC0yMDEgLTY3IC0yMDQgLTY0DQogICAtMyAzIC02IDIyNiAtNiA0OTQgbDAgNDg5IDUwIDQgYzExNyA4IDExODUgNiAxMzQ5IC0zeiBtNzcyIC04MzQgYy0zOSAtMTc1DQogICAtMTUzIC0zMjggLTMxNiAtNDI1IC0yNCAtMTQgLTg3IC00MCAtMTM4IC01NyBsLTk0IC0zMSA2OCAtMzIgYzk5IC00NiAxMzYNCiAgIC03NCAyMDIgLTE1NSAxMDMgLTEyNSAxMTAgLTEzNyAzNDYgLTU5NyA3NSAtMTQ2IDEzNiAtMjcxIDEzNiAtMjc4IDAgLTggLTEwNw0KICAgLTExIC00MjAgLTkgbC00MjEgMyAtMTA1IDE5NSBjLTU4IDEwNyAtMTU1IDI4NyAtMjE2IDQwMCAtMTQ1IDI3MCAtMTc2IDMxMg0KICAgLTI0OCAzNTAgLTM3IDE5IC0xMzMgNDAgLTE4MiA0MCBsLTI4IDAgLTIgLTQ5MiAtMyAtNDkzIC0zNzUgMCAtMzc1IDAgLTMgNTg3DQogICAtMiA1ODggNjIgMzIgYzE4NiA5NiAzMzEgMTUwIDUxNyAxOTUgMTAyIDI1IDEyMyAyNiA1MzEgMzMgNDYxIDggNDc2IDEwIDY3NQ0KICAgNzMgNTUgMTcgMTY4IDY1IDI1MCAxMDcgMTcxIDg2IDE2OCA4NyAxNDEgLTM0eiIvPjwvZz48L3N2Zz4=';
        add_menu_page(
            __("Ravand Admin Panel", "ravand"),
            __("Ravand", "ravand"),
            'manage_options',
            $this->mainPageSlug,
            [$this, "renderMainAdminMenuPage"],
            $ravandIcon,
            // int $position = null
        );

        $this->addAppearanceSettingsPage();
    }

    public function renderMainAdminMenuPage()
    {
        echo "<pre><code>";
        $args = array(
            'public'   => true,
            '_builtin' => false,
         );
     
         $output = 'names'; // names or objects, note names is the default
         $operator = 'and'; // 'and' or 'or'
     
         $post_types = get_post_types( $args, $output, $operator ); 
     
         var_dump($post_types);
        echo "</code></pre>";
    }

    public function addAppearanceSettingsPage()
    {
        $this->enqueueColorPicker();

        $appearanceSettings = new \Ravand\Settings\Appearance("ravand-appearance","ravand-appearance");

        $appearanceSettings->registerSections();

        add_submenu_page(
            $this->mainPageSlug,
            __("Ravand Appearance Settings", "ravand"),
            __("Appearance", "ravand"),
            'manage_options',
            'ravand-appearance',
            function () use ($appearanceSettings) {
                require $this->plugin->resourcePath("views/admin/appearance.php");
            }
        );
    }

    private function enqueueColorPicker()
    {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }
}
