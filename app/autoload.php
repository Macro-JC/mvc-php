<?php 

//Load Config
require_once 'config/Config.php';


// Load Libs
/*
    require_once 'libs/Database.php';
    require_once 'libs/Controller.php';
    require_once 'libs/Core.php';
*/

spl_autoload_register(function($nameClass){
    require_once 'libs/'.$nameClass.'.php';
});
