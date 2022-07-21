<?php

return [
    "eager" => [
    ],

    "deferred" => [
        \Pluguin\Database\MigrationServiceProvider::class => [
            "migrator",
            "migration.repository"
        ]
    ],

    "when" => [
        // Provider => Events
    ]
];
