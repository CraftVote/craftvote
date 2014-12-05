<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of ViewFactory
 *
 * @author Ivan
 */
class ViewFactory {
    
    static function getView(\System\CommandContext $request){
        $action = $request->getAction();
        $class = ucfirst(strtolower($action)).'View';
        if ($request->getPath() === null){
            $path = DIRECTORY_SEPARATOR;
        }
        else {
            $path = DIRECTORY_SEPARATOR . $request->getPath();
        }
        $file = PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views'. $path . $class . '.php';
        if (!file_exists($file)){
            throw new \System\Exception('File "'.$file.'" not found');
        }
        require_once $file;
        if (!class_exists($class)){
            throw new \System\Exception('Class "'.$class.'" not found');
        }
        return new $class($request);
    }
}
