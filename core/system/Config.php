<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Config
 *
 * @author Ivan
 */
class Config {
    
    static private $params = array();
    
    static public function get($name) {
        if (!isset(self::$params[$name])){
            throw new \System\Exception('Not found "'.$name.'" param in the config');
        }
        return self::$params[$name];
    }
    
    static public function load(array $array) {
        self::$params = $array;
    }
}
