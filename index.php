<?php


    $config = array(
            
            'now' => 'development',
        
            'environment' => array(
                'production' => array(
                    'debug' => false,
                    'cache' => true,
                    'cache_host' => 'localhost',
                    'db_host' => 'localhost',
                    'db_name' => 'craftvote',
                    'db_user' => 'root',
                    'db_password' => '',
                    'admin_email' => 'ivan.shib@gmail.com'
                ),
                'development' => array(
                    'debug' => true,
                    'cache' => false,
                    'cache_host' => 'localhost',
                    'db_host' => 'localhost',
                    'db_name' => 'craftvote',
                    'db_user' => 'root',
                    'db_password' => '',
                    'admin_email' => 'ivan.shib@gmail.com'
                )
            )
    );
    
    define('PATH', __DIR__);
    require_once PATH. DIRECTORY_SEPARATOR .'core'. DIRECTORY_SEPARATOR. 'system'. DIRECTORY_SEPARATOR. 'Autoload.php';
    \System\Autoload::init();
    \System\FrontController::run($config);