<?php

return function($pluginFile) {

    if(!defined("PLUGUIN"))
    {

        add_action( 'admin_init',  );
        register_activation_hook($pluginFile, )
        
        deactivate_plugins( plugin_basename( __FILE__ ) );
    }
    
};