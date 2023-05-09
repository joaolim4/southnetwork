<?php
    session_start();
    require('vendor/autoload.php');

    define("INCLUDE_PATH_STATIC","http://localhost/Main/Views/pages/");
    define("INCLUDE_PATH","http://localhost/");
    define("BASE_DIR_PAINEL",__DIR__."/Saves");
    define("API_URL","https://localhost/Main/api.php"); 
    define("API_URL2","http://localhost/Main/api.php"); 
    $app = new Main\Application();
    $app->run();
    
?> 