<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of ApplicationRegistry
 *
 * @author ishibkikh
 */
class ApplicationRegistry extends FileRegistry {
    
    static private function setConfig(){
        $filename = PATH . DIRECTORY_SEPARATOR .  'config' . DIRECTORY_SEPARATOR . 'main.ini';
        $ini = new \System\IniFile($filename);
        if ($ini->setSection('now')->isOnValue('production')){
            $mode = 'production';
        }
        else {
            $mode = 'development';
        }
        $ini->setSection($mode);
        $config = new \System\Config($ini->exportSection());
        self::instance()->set('app_config', $config);
        return $config;
    }

    static public function getConfig()
    {
        $config = self::instance()->get('app_config');
        if ($config === null){
            $config = self::setConfig();
        }
        return $config;
    }
        
}
