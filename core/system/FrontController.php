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
    
    protected function onInit(){
        
        \System\Logger::init();
        \System\Session::init();
        
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
    }
    
    
    protected function onEnd(){
        
        \DB\MySQL\Connector::disconect();
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

    static public function run(){
        $instance = new self();
        $instance->onInit();
        $service = new \System\Service();
        $context = $service->getContext();
        if ($context->getResponseCode() === 404){
            unset($service);
            unset($context);
            $service = new \System\Service('/_system/page404');
            $context = $service->getContext();
        }
        if ($context->getResponseCode() === 401){
            unset($service);
            unset($context);
            $service = new \System\Service('/_system/page401');
            $context = $service->getContext();
        }
        if ((!headers_sent())and(!$context->isCloseRunning())){
            new \System\Transmitter($context);
        }
        $instance->onEnd();
        exit;
    }
}
