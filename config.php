<?php

return [

    "plugin" => [

        "slug" => "ravand",

        "version" => "1.4.1",
        
        "providers" => [
            "eager" => [
                \Pluguin\Database\DatabaseServiceProvider::class,
                Ravand\Providers\ActionServiceProvider::class,
            ],

            "deferred" => [
                \Pluguin\Database\MigrationServiceProvider::class => [

                ],

                Ravand\Providers\AdminServiceProvider::class => [

                ],
                Ravand\Providers\AjaxServiceProvider::class => [

                ],
                Ravand\Providers\HookServiceProvider::class => [

                ],
                Ravand\Providers\RestServiceProvider::class => [
                    
                ],
                Ravand\Providers\ShortCodeServiceProvider::class => [

                ],
            ],
        ],

        "debug" => false,
    ],
    "database" => [
        "migrations" => [
            \Ravand\Database\Migrations\CreateTestTable::class
        ]
    ]
];
