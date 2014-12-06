<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Auth;

/**
 * Description of User
 *
 * @author ishibkikh
 */

class User extends SessionRegistry {
    
    const ROLE_SADMIN   = 'sadmin',
          ROLE_ADMIN = 'admin',
          ROLE_EDITOR  = 'editor',
          ROLE_AUTHOR  = 'author',
          ROLE_MEMBER = 'member';
          
    
    static public function init(){
      
        $basedir = PATH . DIRECTORY_SEPARATOR . 'tmp'. DIRECTORY_SEPARATOR . 'sessions';
        if (!file_exists($basedir)){
            mkdir($basedir);
        }
        session_name('SID');
        session_save_path($basedir);
        session_set_cookie_params(900000, '/', NULL, false, true);
        if (isset($_COOKIE[session_name()])){
            session_start();
            if (self::isAuth()){
                self::checkIP();
                self::checkUserAgent();
            }
        }
    }
  
    static protected function checkIP(){
        $origin = parent::instance()->get('ip');
        $real = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
        if ($origin <> $real){
            self::unregistry();
        }
    }
    
    static protected function checkUserAgent(){
        $origin = parent::instance()->get('useragent');
        $real = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING);
        if ($origin <> $real){
            self::unregistry();
        }
    }

    static public function getRole($role_id = null){
        if ($role_id === null){
            return parent::instance()->get('role');
        }
        else {
            switch ($role_id){
                case 1: return self::ROLE_SADMIN;
                case 2: return self::ROLE_ADMIN;
                case 3: return self::ROLE_EDITOR;
                case 4: return self::ROLE_AUTHOR;
                case 5: return self::ROLE_MEMBER;
                default : 6;
            }
        }
    }
    
    static public function getLastVisitDate($session_id = null){
        if ($session_id === null){
            $file = self::getSessionPath(). DIRECTORY_SEPARATOR. 'sess_' . self::getSessionHash();
        }
        else {
            $file = self::getSessionPath(). DIRECTORY_SEPARATOR. 'sess_' . $session_id;
        }
        
        if (!file_exists($file)){
            return 'unauthorized';
        }
        else{
            return date('Y-m-d H:i:s', filemtime($file));
        }
    }

    static public function getId(){
        return parent::instance()->get('id');
    }
    
    static public function isAuth(){
        if (\session_status() === PHP_SESSION_ACTIVE){
            if (intval(self::getRoleId(parent::instance()->get('role'))) > 0){
                return true;
            }
        }
        return false;
    }
    
    static public function getName(){
        return parent::instance()->get('name');
    }
    
    static public function getSessionHash(){
        return session_id();
    }
    
    static protected function getSessionPath(){
        return session_save_path();
    }

    static public function deleteSession($hash){
        $file = self::getSessionPath() . DIRECTORY_SEPARATOR . 'sess_'. $hash;
        if (file_exists($file)){
            unlink($file);
        }
    }
    
    static public function unregistry() {
        if (self::isAuth()){
            session_destroy();
        }
        setcookie(session_name(),'',0,'/');
    }

    static public function registry(\Models\Tables\Users $user) {
        if (session_status !== PHP_SESSION_ACTIVE){
            session_start();
        }
        if (($user->session <> self::getSessionHash())and($user->session != NULL)){
            $file = self::getSessionPath() . DIRECTORY_SEPARATOR . 'sess_'. $user->session;
            if (file_exists($file)){
                unlink($file);
            }
        }
        parent::instance()->set('id', $user->id);
        parent::instance()->set('name', $user->name);
        parent::instance()->set('role', $user->role);
        parent::instance()->set('ip', filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING));
        parent::instance()->set('useragent', filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_SANITIZE_STRING));
    }
    
    static public function getRoleId($role = null){
        if ($role === null){
            $role = self::getRole();
        }
        switch ($role){
            case self::ROLE_SADMIN: return 1;
            case self::ROLE_ADMIN: return 2;
            case self::ROLE_EDITOR: return 3;
            case self::ROLE_AUTHOR: return 4;
            case self::ROLE_MEMBER: return 5;
            default : return 6;
        }
    }
    
    static public function getRoleColor($role = null){
        if ($role === null){
            $role = self::getRole();
        }
        switch ($role){
            case self::ROLE_SADMIN: return 'label-danger';
            case self::ROLE_ADMIN: return 'label-primary';
            case self::ROLE_EDITOR: return 'label-info';
            case self::ROLE_AUTHOR: return 'label-warning';
            case self::ROLE_MEMBER: return 'label-default';
            default : return null;
        }
    }
}
