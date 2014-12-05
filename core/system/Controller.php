<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Command
 *
 * @author ishibkikh
 */
abstract class Controller {
    
    protected $context;
    
    abstract public function execute();
    abstract public function allowAccess();
    
    public function close(){
        $this->context->setCloseRunning();
        $this->context->setComplited();
    }
    
    public function __construct(CommandContext $request) {
        $this->context = $request;
    }
    
    public function setComplited(){
        $this->context->setComplited();
    }
     
    public function getUrlValue(){
        return $this->context->getUrlValue();
    }
    
    public function getUrlPoints(){
        if ($this->context->getPath() === null){
            return 0;
        }
        else{
            $array = explode(DIRECTORY_SEPARATOR, $this->context->getPath());
            return count($array);
        }
    }
    
    public function getUrlPoint($idx){
        
        $params = array();
        $count = preg_match_all("/\/([-_0-9a-z.]+)/", strtolower(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING)), $params);

        if ($count === null){
            return null;
        }
        
        if (isset($params[1][$idx])){
            return $params[1][$idx];
        }
        return null;
    }
    
    public function moveTo($action, $value = null){
        $this->context->setUrlValue($value);
        $items = explode(' ', $action);
        if (count($items)>0){
            $this->context->setAction(ucfirst(array_pop($items)));
            $this->context->setPath(implode(DIRECTORY_SEPARATOR, $items));
        }
        else{
            $this->context->setAction(ucfirst($action));
            $this->context->setPath(null);
        }
    }
    
    public function redirect($url){
        $this->context->setRedirection($url);
        $this->setComplited();
    }
    
    public function setContentTypeJson(){
        $this->context->setContentType('application/json');
    }
    
    public function setError($msg){
        $this->context->setError($msg);
        $this->context->setAction('Error');
        $this->context->setPath('_system');
    }
    
    public function setParam($name, $value){
        $this->context->setCustomParam($name, $value);
    }
    
    public function responseCode($int){
        $this->context->setResponseCode($int);
    }
    
    public function pageNotFound(){
        $this->responseCode(404);
        $this->context->setAction('Page404');
        $this->context->setPath('_system');
    }
}
