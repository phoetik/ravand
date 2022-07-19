<?php





/**
 * 
 * 
 * 
 * 
 * 
 */

namespace Ravand\Bootstrap;

class Plugin 
{
    private static $initialized = false;

    private static $file;

    public static function register($file)
    {
        if(self::isInitialized()) {
            return;
        }

        self::$file = $file;

        $class = self::class;

        \add_action("pluguin","$class::init");
        \register_activation_hook($file, "$class::activate");
        \register_deactivation_hook($file, "$class::deactivate");
        \register_uninstall_hook($file, "$class::uninstall");
    }

    private static function isInitialized()
    {
        return self::$initialized;
    } 

    public static function init($pluguin)
    {
        self::$initialized = true;

        $plugin = new Ravand\Plugin(
            self::$file
        );

        $pluguin->register($plugin);
    }

}

return function ($pluginFile) {

    new class($pluginFile) {

        private $plugin;
    
        private $basename;
    
        public function __construct($pluginFile)
        {
            $this->plugin = $pluginFile;
            $this->basename = plugin_basename($this->plugin);
    
            add_action("plugins_loaded", [$this, "pluginsLoadedHook"]);

            register_activation_hook($this->plugin, [$this,"activationHook"]);
        }
    
        public function pluginsLoadedHook()
        {
            if (!defined("PLUGUIN")) {
                add_action('admin_init', [$this, 'adminHook']);
                register_activation_hook($this->plugin, [$this,"activationHook"]);
            }
        }
    
        public function adminHook()
        {
            if ($this->deactivateIfPluginIsActive()) {
                add_action('admin_notices', [$this, 'pluguinNotice' ]);
                $this->unsetActivationParameter();
            }
        }
    
        public function pluguinNotice()
        {
            ?>
                <div class="notice notice-error is-dismissible">
                    <strong>
                        <p><?php echo $this->pluguinRequiredMessage(); ?></p>
                    </strong>
                </div>
            <?php
        }
        
        private function unsetActivationParameter()
        {
            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }
        }
    
        private function pluguinRequiredMessage()
        {
            echo 'This Plugin requires <a href="https://wordpress.org/plugins/pluguin/">Pluguin</a> to be able to get activated, deactivated or uninstalled.';
        }
    
        public function activationHook()
        {
            $this->deactivateIfPluginIsActive();
        }
    
    
        private function deactivateIfPluginIsActive()
        {
            if (is_plugin_active($this->basename)) {
                deactivate_plugins($this->basename, $silent = true);
                
                return true;
            }
            
            return false;
        }
    
    };
};
