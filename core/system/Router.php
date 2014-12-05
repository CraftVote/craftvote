<?php

/*
 * Ver. 2.0
 */

/**
 * URL Routing
 *
 * @author ishibkikh
 */
namespace System;

class Router
{
    const PAGE_DEFAULD   = 'Index';
    const PAGE_AUTOLOAD   = 'Autoload';
    
    private $count, $raw = array(), $request;
    
    public function __construct(\System\CommandContext $request){
        $this->request = $request;
    }

    public function assignFromURL(){
        $params = array();
        $this->count = preg_match_all("/\/([-_0-9a-z.]+)/", strtolower(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING)), $params);
        $this->raw = $params[1];
        $this->parse();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->request->setPostMethod();
        }
        else{
            $this->request->setGetMethod();
        }
    }
    
    public function assignFromString($url, $method = 'GET'){
        $params = array();
        $this->count = preg_match_all("/\/([-_0-9a-z.]+)/", strtolower($url), $params);
        $this->raw = $params[1];
        $this->parse();
        if ($method === 'POST'){
            $this->request->setPostMethod();
        }
        else{
            $this->request->setGetMethod();
        }
    }
    
    protected function parse(){
        
        if ($this->_routRoot()){
            return true;
        }
        if ($this->_routDirect()){
            return true;
        }
        if ($this->_routIndex()){
            return true;
        }
        if ($this->_routDirectParam()){
            return true;
        }
        if ($this->_routAutoload()){
            return true;
        }    
        $this->setNotFound();
    }
    
    private function _routRoot(){
        if ($this->count === 0){
            $this->request->setUrlValue(null);
            $this->request->setAction(self::PAGE_DEFAULD);
            $this->request->setPath(null);
            return true;
        }    
        else{
            return false;
        }
    }    
      
    private function _routDirect(){
        $array = $this->raw;
        $this->request->setUrlValue(null);
        $this->request->setAction(array_pop($array));
        if (count($array) > 0){
            $this->request->setPath(implode(DIRECTORY_SEPARATOR, $array));
        }
        else{
            $this->request->setPath(null);
        }
        return $this->isCommandExists();
    }
    
    private function _routIndex(){
        $this->request->setUrlValue(null);
        $this->request->setAction(self::PAGE_DEFAULD);
        $this->request->setPath(implode(DIRECTORY_SEPARATOR, $this->raw));
        return $this->isCommandExists();
    }
    
    private function _routDirectParam(){
        if (count($this->raw)<2){
            return false;
        }
        $array = $this->raw;
        $this->request->setUrlValue(array_pop($array));
        $this->request->setAction(array_pop($array));
        if (count($array) > 0){
            $this->request->setPath(implode(DIRECTORY_SEPARATOR, $array));
        }
        else{
            $this->request->setPath(null);
        }
        return $this->isCommandExists();
    }
    
    private function _routAutoload(){
        $array = $this->raw;
        $this->request->setUrlValue(array_pop($array));
        $this->request->setAction(self::PAGE_AUTOLOAD);
        if (count($array) > 0){
            $this->request->setPath(implode(DIRECTORY_SEPARATOR, $array));
        }
        else{
            $this->request->setPath(null);
        }
        return $this->isCommandExists();
    }
    
    private function setNotFound(){
        $this->request->setResponseCode(404);
    }
        
    private function isCommandExists(){
        if ($this->request->getPath() === null){
            $path = DIRECTORY_SEPARATOR;
        }
        else{
            $path = DIRECTORY_SEPARATOR . $this->request->getPath() . DIRECTORY_SEPARATOR;
        }
        $file =  PATH. DIRECTORY_SEPARATOR. 'application'. DIRECTORY_SEPARATOR. 'actions'. $path . ucfirst($this->request->getAction()) . 'Command.php';
        if (!file_exists($file)){
            return false;
        }
        else {
            return true;
        }
    }
}