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

class User {
    
    const ROLE_SADMIN   = 'sadmin',
          ROLE_ADMIN = 'admin',
          ROLE_EDITOR  = 'editor',
          ROLE_AUTHOR  = 'author',
          ROLE_MEMBER = 'member';
          
    static public function getRole($role_id = null){
        if ($role_id === null){
            return \System\Session::get('role');
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
    
    static public function getId(){
        return \System\Session::get('id');
    }
    
    static public function isAuth(){
        if (\session_status() === PHP_SESSION_ACTIVE){
            if (intval(\System\Session::get('id')) > 0){
                return true;
            }
        }
        return false;
    }
    
    static public function getName(){
        return \System\Session::get('name');
    }
    
    static public function auth(\Models\Tables\Users $user) {
        \System\Session::startNew();
        if (($user->session <> session_id())and($user->session != NULL)){
            \System\Session::deleteFile($user->session);
        }
        \System\Session::set('id', $user->id);
        \System\Session::set('name', $user->name);
        \System\Session::set('role', $user->role);
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
