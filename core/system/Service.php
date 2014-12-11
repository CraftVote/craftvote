<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Widget
 *
 * @author Ivan
 */
class Service {
    
    private $request;
    
    public function __construct($request_string = null){
        
        if ($request_string === NULL){
            $this->getFromServer();
            return;
        }
        
        $sub = null;
        if (strlen($request_string)>6){
            $sub = substr($request_string, 0, 6);
        }
        if (($sub === 'http:/')or($sub === 'https:')){
            $this->getFromHost($request_string);
        }
        else {
            $this->getFromLocal($request_string);
        }
    }
    
    public function getFromServer(){
        $this->request = new \System\CommandContext();
        $router = new Router($this->request);
        $router->assignFromURL();
        if ($this->request->getResponseCode() === 404){
            $this->request->setBuffer('<p class="bg-danger">404 Page Not Found</p>');
            return;
        }
        $this->handleRequest($this->request);
        if ($this->request->getResponseCode() === 401){
            $this->request->setBuffer('<p class="bg-danger">401 Unauthorized</p>');
            return;
        }
        if (!$this->request->isComplited()){
           $this->handleView($this->request);
        }
    }
    
    public function getFromHost($string){
        return false;
    }
    
    public function getFromLocal($string){
        $this->request = new \System\CommandContext();
        $router = new Router($this->request);
        $router->assignFromString($string);
        if ($this->request->getResponseCode() === 404){
            $this->request->setBuffer('<p class="bg-danger">404 Page Not Found</p>');
            return;
        }
        $this->handleRequest($this->request);
        if ($this->request->getResponseCode() === 401){
            $this->request->setBuffer('<p class="bg-danger">401 Unauthorized</p>');
            return;
        }
        if (!$this->request->isComplited()){
            $this->handleView($this->request);
        }
    }
    
    public function getContext(){
        return $this->request;
    }
    
    public function getResponseCode(){
        return $this->request->getResponseCode();
    }
    
    public function getContent(){
        if ($this->request->isError()){
            return '{'.$this->request->getError().'}';
        }
        $this->request->setBuffer(str_replace('<!--BODY-->', '', $this->request->getBuffer()));
        return $this->request->getBuffer();
    }
    
    protected function executeMethod($cmd, $methodName, $values){
        $count = count($values);
        if ($count === 0){
            $cmd->{$methodName}();
            return;
        }
        $reflect = new \ReflectionMethod($cmd, $methodName);
        if ($reflect->getNumberOfRequiredParameters() !== $count){
            $cmd->pageNotFound();
            return;
        }
        if (call_user_func_array(array($cmd, $methodName), array_reverse($values)) === FALSE){
            throw new \System\Exception('Unable to call method "'.$methodName.'" in '.  get_class($cmd));
        }
    }

    protected function handleRequest(\System\CommandContext $request){
        $cmd = \System\CommandFactory::getCommand($request);
        if (!is_subclass_of($cmd, '\System\Controller')){
            throw new \System\Exception('Class "'.get_class($cmd).'" should be executable');
        }
        $access = $cmd->allowAccess();
        if ($access !== NULL){
            if (\Auth\User::getRoleId($access) < \Auth\User::getRoleId()){
                $request->setResponseCode(401);
                return;
            }
        }
        if ($request->isPostMethod()){
            $this->executeMethod($cmd, 'post', $request->getUrlValues());
        }
        else{
            $this->executeMethod($cmd, 'get', $request->getUrlValues());
        }
    }
    
    protected function handleView(\System\CommandContext $request){

        $view = \System\ViewFactory::getView($request);
        if (!is_subclass_of($view, '\System\View')){
            throw new \System\Exception('Class "'.get_class($view).'" must be extended from "View" class');
        }
        $view->execute();
     }
}