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
class FileRegistry {
    
    static protected $values = array();
    static protected $mtimes = array();
    
    private static $instance;
    
    private function __construct() {}
    
    static protected function instance(){
        if (! isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
       
    protected function get($key) {
        
        $path = $this->getBaseDir() . DIRECTORY_SEPARATOR . base64_encode($key);
        if (file_exists($path)){
            clearstatcache();
            $mtime = filemtime($path);
            if(! isset(self::$mtimes[$key])){
                self::$mtimes[$key] = 0;
            }
            if ($mtime > self::$mtimes[$key]){
                $data = file_get_contents($path);
                self::$mtimes[$key] = $mtime;
                return (self::$values[$key] = unserialize($data));
            }
            if (isset(self::$values[$key])){
                return self::$values[$key];
            }
        }
        return NULL;
    }
    
    protected function set($key, $value) {
        self::$values[$key] = $value;
        $path = $this->getBaseDir() . DIRECTORY_SEPARATOR . base64_encode($key);
        file_put_contents($path, serialize($value));
        self::$mtimes[$key] = time();
    }
    
    protected function getBaseDir(){
        
        $basedir = PATH . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'cache';
        if (!file_exists($basedir)){
            mkdir($basedir);
        }
        return $basedir;
    }
}
