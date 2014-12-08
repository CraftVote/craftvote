<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Session
 *
 * @author ishibkikh
 */
class Session {
    
    const   NAME = 'SID',
            TIMELIFE = 90000;
    
    static public function getBaseDir(){
        $dir = PATH.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'sessions';
        if (!file_exists($dir)){
            mkdir($dir);
        }
        return $dir;
    }

    static public function init(){
        session_name(self::NAME);
        session_save_path(self::getBaseDir());
        session_set_cookie_params(self::TIMELIFE, '/', NULL, false, true);
        self::startOld();
    }
    
    static public function startOld(){
        if (isset($_COOKIE[self::NAME])){
            if (self::start()){
                self::checkIP();
                self::checkUserAgent();
            }
        }
    }
    
    static public function startNew(){
        if (self::start()){
            self::set('ip', filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING));
            self::set('useragent', filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING));
        }
    }
    
    static public function start(){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
            return true;
        }
        else{
            return false;
        }
    }
    
    static public function stop(){
        if (session_status() == PHP_SESSION_ACTIVE){
            session_destroy();
            setcookie(self::NAME,'',0,'/');
        }
    }
    
    static public function set($key, $value){
        $_SESSION[__CLASS__][$key] = $value;
    }
    
    static public function get($key){
        if (isset($_SESSION[__CLASS__][$key])){
            return $_SESSION[__CLASS__][$key];
        }
        return null;
    }
    
    static public function delete($key) {
        if (isset($_SESSION[__CLASS__][$key])){
            unset($_SESSION[__CLASS__][$key]);
        }
    }
    
    static protected function checkIP(){
        $origin = self::get('ip');
        $real = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
        if ($origin <> $real){
            self::stop();
        }
    }
    
    static protected function checkUserAgent(){
        $origin = self::get('useragent');
        $real = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING);
        if ($origin <> $real){
            self::stop();
        }
    }
    
    static public function getLastVisitDate($session_id = null){
        if ($session_id === null){
            $file = self::getBaseDir().DIRECTORY_SEPARATOR.'sess_'.session_id();
        }
        else {
            $file = self::getBaseDir().DIRECTORY_SEPARATOR.'sess_'.$session_id;
        }
        if (!file_exists($file)){
            return 'unauthorized';
        }
        else{
            return date('Y-m-d H:i:s', filemtime($file));
        }
    }
    
    static public function deleteFile($hash){
        $file = self::getBaseDir().DIRECTORY_SEPARATOR.'sess_'.$hash;
        if (file_exists($file)){
            unlink($file);
        }
    }
}
