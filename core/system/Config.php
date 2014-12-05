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
    
    private $params = array();
    
    public function __get($name) {
        if (!isset($this->params[$name])){
            throw new \System\Exception('Not found "'.$name.'" param in the config');
        }
        return $this->params[$name];
    }
    
    public function __set($name, $value) {
        throw new \System\Exception('You cannot rewrite exists config params');
    }
    
    public function __construct(array $array) {
        $this->params = $array;
    }
}
