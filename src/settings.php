<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // database connection details         
        "db_local" => [            
            "host" => "localhost",             
            "dbname" => "api",             
            "user" => "root",            
            "pass" => ""        
        ],

        // database connection details WEB (Hostgator)
        "db_web" => [            
            "host" => "localhost",             
            "dbname" => "web7s526_api",             
            "user" => "web7s526",            
            "pass" => "gaspar15"
        ],

        "jwt" => [
            'secret' => 'supersecretkeyyoushouldnotcommittogithub'
        ]

    ],
];
