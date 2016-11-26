<?php

$config = array(
    "baseUrl"  => !defined('PRODUCTION') || PRODUCTION != 1 ? "http://domain.local/" : "http://domain.production",
    "database" => array(
        "adapter"  => "Mysql",
        "host"     => !defined('PRODUCTION') || PRODUCTION != 1 ? "127.0.0.1" : "localhost",
        "username" => !defined('PRODUCTION') || PRODUCTION != 1 ? "root" : "root",
        "password" => !defined('PRODUCTION') || PRODUCTION != 1 ? "password" : "password",
        "dbname"   => !defined('PRODUCTION') || PRODUCTION != 1 ? "dbname" : "dbname",
    ),
     "application" => array(
        'controllersDir'     => __DIR__ . '/../../app/controllers/',
        'constantsDir'       => __DIR__ . '/constants/',
        'modelsDir'          => __DIR__ . '/../../app/models/',
        'viewsDir'           => __DIR__ . '/../../app/views/',
        'pluginsDir'         => __DIR__ . '/../../app/plugins/',
        'libraryDir'         => __DIR__ . '/../../app/library/',
        'servicesDir'        => __DIR__ . '/../../app/services/',
        'daoDir'             => __DIR__ . '/../../app/daos/',
        'helpersDir'         => __DIR__ . '/../../app/helpers/',
        'inputModelsDir'     => __DIR__ . '/../../app/inputmodels/',
        'inputValidatorsDir' => __DIR__ . '/../../app/inputvalidators/',
        'exceptionsDir'      => __DIR__ . '/../../app/exceptions/',
        'viewModelsDir'      => __DIR__ . '/../../app/viewmodels/',
        'cacheDir'           => __DIR__ . '/../../app/cache/',
        'baseUri'            => '',
    ),
    "logPaths" => array(
        'default' => !defined('PRODUCTION') || PRODUCTION != 1 ? "/opt/local/var/log/default.log" : "/var/log/default.log",
    )
);