<?php

return function ($pluginFile) {

    new class($pluginFile) {

        private $plugin;
    
        private $basename;
    
        public function __construct($pluginFile)
        {
            $this->plugin = $pluginFile;
            $this->basename = plugin_basename($this->plugin);
    
            add_action("plugins_loaded", [$this, "pluginsLoadedHook"]);
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
