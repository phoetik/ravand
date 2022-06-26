<?php

return [
    "plugin" => [
        "providers" => [
            "eager" => [
                Ravand\Providers\ActionServiceProvider::class,
            ],

            "deferred" => [
                Ravand\Providers\AdminServiceProvider::class,
                Ravand\Providers\AjaxServiceProvider::class,
                Ravand\Providers\HookServiceProvider::class,
                Ravand\Providers\RestServiceProvider::class,
                Ravand\Providers\ShortCodeServiceProvider::class,
            ],
        ],

        "debug" => false,
    ],
];
