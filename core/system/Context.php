<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of CommandContext
 *
 * @author ishibkikh
 */
class Context {
    
    private $params = array();
    
    protected function set($section, $key, $val){
        $this->params[$section][$key] = $val;
    }
     
    protected function get($section, $key){
        if (!isset($this->params[$section][$key])){
            return null;
        }
        return $this->params[$section][$key];
    }
}
