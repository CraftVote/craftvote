<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace System;
/**
 * Description of FrontController
 *
 * @author ishibkikh
 */
class FrontController {
    
    private function __construct(){}
    
    protected function init(){
        
        $config = \System\ApplicationRegistry::getConfig();
        
        ini_set('display_errors','0');
        ini_set('log_errors', '1');
        ini_set('error_reporting', E_ERROR);
        
        if ($config->debug == 1){
            ini_set('display_errors','1');
            ini_set('log_errors', '0');
            ini_set("error_reporting", E_ALL ^ E_NOTICE);
        }
        else{
            ini_set('display_errors','0');
            ini_set('log_errors', '1');
            ini_set('error_reporting', E_ERROR);
        }
        date_default_timezone_set($config->timezone);
        ini_set('default_charset', 'UTF-8');
        ini_set("zlib.output_compression", 'on');
        \System\Logger::init();
        \Auth\User::init();
    }
    
    protected function checkAccess($role, \System\CommandContext $request, $is_ajax){
        if ($role === null){
            return true;
        }
        if (!\Auth\User::isAuth()){
            if ($is_ajax){
                $request->setAction('Json');
                $request->setPath('auth login');
                $cmd = \System\CommandFactory::getCommand($request);
                $cmd->execute();
            }
            else{
                $request->setAction('Page401');
                $request->setPath('_system');
                $request->setResponseCode(401);
            }
            return false;
        }
        if (\Auth\User::getRoleId() > \Auth\User::getRoleId($role)){
            if ($is_ajax){
                $request->setAction('Page403');
                $request->setPath('_system');
                $cmd = \System\CommandFactory::getCommand($request);
                $cmd->execute();
            }
            else{
                $request->setAction('Page403');
                $request->setPath('_system');
                $request->setResponseCode(403);
            }
            return false;
        }
        return true;
    }


    protected function handleRequest(\System\CommandContext $request){
   
        if ($request->getResponseCode() === 404){
            $request->setAction('Page404');
            $request->setPath('_system');
            return false;
        }
        $cmd = \System\CommandFactory::getCommand($request);
        if (!is_subclass_of($cmd, '\System\Controller')){
            throw new \System\Exception('Class "'.get_class($cmd).'" should be executable');
        }
        if ($this->checkAccess($cmd->allowAccess(), $request, is_subclass_of($cmd, '\System\AjaxController')) === true){
            $cmd->execute();
        }
    }
    
    protected function handleView(\System\CommandContext $request){

        $view = \System\ViewFactory::getView($request);
        if (!is_subclass_of($view, '\System\View')){
            throw new \System\Exception('Class "'.get_class($view).'" must be extended from "View" class');
        }
        $view->execute();
     }

    static public function run(){
        
        $instance = new self();
        $instance->init();
        $context = new \System\CommandContext();
        $router = new \System\Router($context);
        $router->assignFromURL();
        $instance->handleRequest($context);
        if (!$context->isComplited()){
            $instance->handleView($context);
        }
        
        if ((!headers_sent())and(!$context->isCloseRunning())){
            new \System\Transmitter($context);
        }
        exit;
    }
}
