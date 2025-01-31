<?php

return [
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds',
    ],
    'environments' => [
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'agenda_contatos', 
            'user' => 'root', 
            'pass' => '1234', 
            'port' => '3306',
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation'
];