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
        $this->count = preg_match_all("/([-_0-9a-z.]+)/", strtolower($url), $params);
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
        if ($this->_routDirectParam()){
            return true;
        }
        $this->setNotFound();
    }
    
    private function _routRoot(){
        if ($this->count === 0){
            $this->request->setUrlValues(null);
            $this->request->setAction('Index');
            $this->request->setPath(null);
            return true;
        }    
        else{
            return false;
        }
    }
      
    private function _routDirect(){
        $array = $this->raw;
        $this->request->setUrlValues(null);
        $this->request->setAction(array_pop($array));
        if (count($array) > 0){
            $this->request->setPath(implode(DIRECTORY_SEPARATOR, $array));
        }
        else{
            $this->request->setPath(null);
        }
        return $this->isCommandExists();
    }

    
    private function _routDirectParam(){
        if ($this->count < 2){
            return false;
        }
        $array = $this->raw;
        $action = array_pop($array);
        $values = array();
        for($i=0; $i < $this->count; $i++){
            $values[] = $action;
            $action = array_pop($array);
            $this->request->setAction($action);
            $this->request->setUrlValues($values);
            if (count($array) > 0){
                $this->request->setPath(implode(DIRECTORY_SEPARATOR, $array));
            }
            else{
                $this->request->setPath(null);
            }
            if ($this->isCommandExists()){
                return true;
            }
        }
        return false;
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
        $file = PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'actions'.$path.ucfirst($this->request->getAction()).'Controller.php';
        if (!file_exists($file)){
            return false;
        }
        else {
            
            return true;
        }
    }
}