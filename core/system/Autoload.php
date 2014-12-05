<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SysAutoload
 *
 * @author ishibkikh
 */
namespace System;

class Autoload
{
    public static function init()
    {
        spl_autoload_register(array('System\Autoload','autoload'));
    }
    
        
    static public function autoload($class)
    {
        $lastSlashPos = strrpos($class, '\\');
        $namespaces = substr($class, 0, $lastSlashPos);
        $finiteClass = substr($class, $lastSlashPos+1, strlen($class));
        $path = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($namespaces));
        
        $file = PATH . DIRECTORY_SEPARATOR . 'core'. DIRECTORY_SEPARATOR . $path. DIRECTORY_SEPARATOR . $finiteClass. '.php';
        if (file_exists($file)){
            require_once $file;
            return;
        }
        
        $file = PATH . DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . $path. DIRECTORY_SEPARATOR . $finiteClass. '.php';
        if (file_exists($file)){
            require_once $file;
        }
        else{
            throw new \Exception('Can not autoload class "'.$class.'"');
        }
    }
}