<?php
    define('PATH', __DIR__);
    require_once PATH. DIRECTORY_SEPARATOR .'core'. DIRECTORY_SEPARATOR. 'system'. DIRECTORY_SEPARATOR. 'Autoload.php';
    \System\Autoload::init();
    \System\FrontController::run();