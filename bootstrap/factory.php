<?php

namespace Ravand\Bootstrap;

class Factory
{
    private static $plugin;

    public function __invoke($file)
    {
        if (isset(self::$plugin)) {
            return self::$plugin;
        }

        return self::$plugin = $this->bootstrap($file);
    }

    public function bootstrap($file)
    {
        return new Ravand\Plugin($file);
    }
}
