<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of CommandFactory
 *
 * @author ishibkikh
 */
class CommandFactory {
    
    static public function getCommand(\System\CommandContext $context){
        
        $action = $context->getAction();
        if ($context->getPath() === null){
            $path = DIRECTORY_SEPARATOR;
        }
        else {
            $path = DIRECTORY_SEPARATOR . str_replace(' ', DIRECTORY_SEPARATOR, $context->getPath()). DIRECTORY_SEPARATOR;
        }
        if ($action === null){
            throw new \System\Exception('Invalid action for object create');
        }
        $class = ucfirst(strtolower($action)).'Controller';
        $file =  PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'actions'. $path . $class . '.php';
        if (!file_exists($file)){
            throw new \System\Exception('File "'.$file.'" not found');
        }
        require_once $file;
        if (!class_exists($class)){
            throw new \System\Exception('Class "'.$class.'" not found');
        }
        return new $class($context);
    }
    
}
