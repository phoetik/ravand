<?php

namespace Ravand\Providers;

return [
    "eager" => [
        PluginServiceProvider::class
    ],

    "deferred" => [
        
    ],

    "when" => [
        AdminServiceProvider::class => [
            "wp-admin-request"
        ]
    ]
];
