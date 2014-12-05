<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of IniFile
 *
 * @author Ivan
 */
class IniFile {
    
    private $file, $section;
    
    public function __construct($filename) {
        if (!file_exists($filename)){
            throw new \System\Exception('INI file not found: '.$filename);
        }
        $this->file = parse_ini_file($filename, true);
    }
    
    public function isOnValue($key){
        if ($this->section === NULL){
            throw new \System\Exception('Connot get param, please set section before');
        }
        if (!isset($this->file[$this->section][$key])){
            throw new \System\Exception('Key "'.$key.'" of "'.$this->section.'" section not found in INI file');
        }
        if ($this->file[$this->section][$key] === '1'){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function setSection($section){
        if (isset($this->file[$section])){
            $this->section = $section;
        }
        else{
            throw new \System\Exception('Section "'.$section.'" not found in INI file');
        }
        return $this;
    }
    
    public function exportSection(){
        if ($this->section === NULL){
            throw new \System\Exception('Connot get param, please set section before');
        }
        $array = array();
        foreach ($this->file[$this->section] as $key => $value){
            if ($value === ''){
                $array[$key] = false;
                continue;
            }
            if ($value === '1'){
                $array[$key] = true;
                continue;
            }
            $array[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        return $array;
    }

    public function get($key){
        if ($this->section === NULL){
            throw new \System\Exception('Connot get param, please set section before');
        }
        if (!isset($this->file[$this->section][$key])){
            throw new \System\Exception('Key "'.$key.'" of "'.$this->section.'" section not found in INI file');
        }
        return $this->file[$this->section][$key];
    }
}
