<?php

    //Route App
    define('ROUTE_APP', dirname(dirname(__FILE__)));
    
    // Route URL
    define('ROUTE_URL', '/');
    
    // Name Site
    define('NAME_SITE', 'MVC PHP');

    // Config Access Database
    define('DB_DRIVER','mysql');
    define('DB_HOST',"localhost");
    define('DB_USER','root');
    define('DB_PASSWORD','');
    define('DB_NAME','');

    define('DB_DSN',[
        'mysql'=>"mysql:host=".DB_HOST.";dbname=".DB_NAME,
        'access' =>"odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=".DB_HOST."; Uid=".DB_USER."; Pwd=".DB_PASSWORD.";charset=UTF-8"
    ]);