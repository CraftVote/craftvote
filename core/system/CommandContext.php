<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Request
 *
 * @author ishibkikh
 */
final class CommandContext extends \System\Context{
    
    public function __construct() {
        $this->setCharset('utf-8');
        $this->setContentType('text/html');
        $this->setResponseCode(200);
    }
    
    public function setCloseRunning(){
        $this->set('system', 'request_close', true);
    }
    
    public function isCloseRunning(){
        return ($this->get('system', 'request_close') === true);
    }
    
    public function setComplited(){
        $this->set('system', 'request_complited', true);
    }
    
    public function isComplited(){
        return ($this->get('system', 'request_complited') === true);
    }
    
    public function setCharset($val){
        $this->set('system', 'request_charset', $val);
    }
    
    public function getCharset(){
        return $this->get('system', 'request_charset');
    }
    
    public function setCustomParam($name, $value){
        $this->set('view', $name, $value);
    }
    
    public function getCustomParam($name){
        return $this->get('view', $name);
    }
    
    public function setPostMethod(){
        $this->set('system', 'request_method', 'POST');
    }
    
    public function isPostMethod(){
        if ($this->get('system', 'request_method') === 'POST'){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function setGetMethod(){
        $this->set('system', 'request_method', 'GET');
    }

    public function getBuffer(){
        return $this->get('system', 'request_buffer');
    }
    
    public function getContentType(){
        return $this->get('system', 'request_content_type');
    }
    
    public function getResponseCode(){
        return $this->get('system', 'request_response_code');
    }

    public function getAction(){
        return $this->get('system', 'request_action');
    }
    
    public function getPath(){
        return $this->get('system', 'request_path');
    }
    
    public function getUrlValues(){
        return $this->get('system', 'request_values');
    }
    
    public function setBuffer($text){
        $this->set('system', 'request_buffer', $text);
    }
    
    public function setContentType($const){
        $this->set('system', 'request_content_type', $const);
    }
    
    public function setResponseCode($int){
        $this->set('system', 'request_response_code', $int);
    }
    
    public function setAction($val){
        $this->set('system', 'request_action', $val);
    }
    
    public function setPath($val){
        $this->set('system', 'request_path', $val);
    }
    
    public function setUrlValues($val){
        $this->set('system', 'request_values', $val);
    }
    
    public function setRedirection($url){
        $this->set('system', 'request_redirection', $url);
    }
    
    public function getRedirection(){
        return $this->get('system', 'request_redirection');
    }
    
    public function setError($text){
        $this->set('system', 'request_error', $text);
    }
    
    public function getError(){
        return $this->get('system', 'request_error');
    }
    
    public function isError(){
        return ($this->getError() !== null);
    }
}
