<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth;

/**
 * Description of SessionRegistry
 *
 * @author ishibkikh
 */
class SessionRegistry {
    
    private static $instance;
    
    private function __construct() {}
    
    static protected function instance(){
        if (! isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    protected function get($key) {
        if (isset($_SESSION[__CLASS__][$key])){
            return $_SESSION[__CLASS__][$key];
        }
        return null;
    }
    
    protected function set($key, $value) {
        $_SESSION[__CLASS__][$key] = $value;
    }
    
    protected function append($key, $value) {
        $_SESSION[__CLASS__][$key][] = $value;
    }
    
    protected function delete($key) {
        if (isset($_SESSION[__CLASS__][$key])){
            unset($_SESSION[__CLASS__][$key]);
        }
    }
}
