<?php


final class Ravandi
{
    private static $instance;

    public $container;

    private function __construct()
    {
        $this->i18n();

        $this->container = new Container;

        $this->registerHooks();

        if ($this->isAdminRequest()) {
            $this->registerAdminActions();
        }

        if ($this->isRestApiRequest()) {
            $this->registerApiActions();
        }
    }

    public static function init()
    {
        if (!self::isInitialized()) {
            $ravand = new self();
            self::setInstance($ravand);
        }
    }

    public static function instance(): Ravand
    {
        if (!self::isInitialized()) {
            throw new RavandIsNotInitialized;
        }

        return self::$instance;
    }

    public static function container()
    {
    }

    private static function setInstance(Ravand $instance): void
    {
        self::$instance = $instance;
    }

    private static function isInitialized(): bool
    {
        return isset(self::$instance);
    }

    /**
     * Registers wordpress activation, deactivation and uninstall hooks
     *
     * @return void
     */
    private function registerHooks()
    {
        $plugin_file = RAVAND_PLUGIN_FILE;

        register_activation_hook($plugin_file, [$this, 'activate']);

        register_deactivation_hook($plugin_file, [$this, 'deactivate']);

        register_uninstall_hook($plugin_file, [$this, 'uninstall']);
    }

    /**
     * Load the plugin's textdomain
     */
    public function i18n()
    {
        add_action("plugins_loaded", function () {
            load_plugin_textdomain('ravand', false, RAVAND_BASE . '/resources/lang/');
        });
    }

    public function activate()
    {
    }

    public function deactivate()
    {
    }

    public function uninstall()
    {
    }

    private $addons = [];

    public static function registerAddOn($addonOrPath)
    {
        if (is_object($addonOrPath)) {
        } elseif (file_exists($classOrPath)) {
        } else {
            throw new InvalidAddonClassOrDirectory;
        }
    }

    private function registerAdminActions()
    {
        add_action('admin_menu', function () {
            wp_enqueue_style("ravand-control-panel", RAVAND_ASSETS . "/css/admin-menu.css");

            require_once __DIR__ . "/admin.php";

            RavandAdmin::init();
        });
    }

    private function registerApiActions()
    {
        add_action('rest_api_init', function () {
            require_once __DIR__ . "/api.php";

            RavandApi::init();
        });

        add_action('rest_api_init', function ($server) {
            $controller = $this->api_controller;
            $this->server = $server;
            $this->controller = new $controller;
            $handler();
        });
    }

    private function isRestApiRequest()
    {
        return defined('REST_REQUEST');
    }

    private function isAdminRequest()
    {
        return \is_admin();
    }

    public function renderControlPanel()
    {
        echo "Booo!";
    }

    public $dashboard_main_slug = "ravand-control-panel";

    public function getDashboardSubmenuList()
    {
        return [
            [
                "title" => "تنظمیات قالب پنل",
                "slug" => "ravand-interface-options",
                // "controller" => []
            ],
        ];
    }

    public function changeSubmenuFirstItemLabel($menu_slug, $new_label)
    {
        global $submenu;

        if (isset($submenu[$menu_slug])) {
            $submenu[$menu_slug][0][0] = $new_label;
        }
    }

    public function addDashboardMenuItems()
    {
        $dashboard_submenu_list = $this->getDashboardSubmenuList();

        foreach ($dashboard_submenu_list as $item) {
            add_submenu_page(
                $this->dashboard_main_slug,
                $item["page_title"] ?? $item["title"],
                $item["title"],
                "manage_options",
                $item["slug"],
                $this->getControllerCallback(
                    // $item["controller"]["name"],
                    // $item["controller"]["function"]??"__invoke",
                    // $item["controller"]["middlewares"]
                )
            );
        }

        $this->changeSubmenuFirstItemLabel($this->dashboard_main_slug, "خانه");
    }

    public function getControllerCallback()
    {
        return fn () => "";
    }
};
