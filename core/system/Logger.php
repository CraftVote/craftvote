<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Loger
 *
 * @author ishibkikh
 */
class Logger {
    
    static public function init(){
        ini_set('error_log', self::getBaseDir() . DIRECTORY_SEPARATOR . 'error.log');
    }
    
    static protected function getBaseDir(){
        $dir = PATH . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'logs';
        if (!file_exists($dir)){
            mkdir($dir);
        }
        return $dir;
    }

    static public function sql($sql)
    {
        self::write('sql.log', $sql);
    }
        
    static public function session($text)
    {
        self::write('session.log', $text);
    }
    
    static public function debug($text)
    {
        self::write('debug.log', $text);
    }
   
    static private function write($file, $text)
    {
        file_put_contents(self::getBaseDir().DIRECTORY_SEPARATOR.$file, date('Y-m-d H:i:s').' '.$text.PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}
