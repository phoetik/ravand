<?php

namespace Ravand\Bootstrap;

class Factory
{
    private static $plugin;

    private $pluginFile;

    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
    }

    public function __invoke()
    {
        if (isset(self::$plugin)) {
            return self::$plugin;
        }

        return [self::$plugin = $this->bootstrap($this->pluginFile)];
    }

    public function getPluginFile()
    {
        return $this->pluginFile;
    }

    public function bootstrap($pluginFile)
    {
        return new \Ravand\Plugin($pluginFile);
    }
}
