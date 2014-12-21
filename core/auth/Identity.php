<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth;

/**
 * Description of Identity
 *
 * @author ishibkikh
 */
class Identity {
    
    static public $error;
    
    static public function login($username, $password){
        
        $user = new \Models\Tables\Users();
        $user->email = $username;
        $mapper = new \DB\MySQL\DataMapper($user);
        if (!$mapper->findOne()){
            self::$error = 'Неверный E-mail';
            return false;
        }
        if (!\System\Password::verify($password, $user->password)){
            self::$error = 'Неверный пароль';
            return false;
        }
        if ($user->active == 0){
            self::$error = 'Ваш аккаунт заблокирован';
            return false;
        }
        if($user->verified == 0){
            self::$error = 'Ваш E-mail не подтверждён';
            return false;
        }

        \Auth\User::auth($user);
        $user->clear();
        $user->session = session_id();
        $mapper->save();
        return true;
    }
    
    
    static public function logout(){
        \System\Session::stop();
    }
    
    
    static public function registry($email, $password, $name, $city){
        
        $user = new \Models\Tables\Users();
        $mapper = new \DB\MySQL\DataMapper($user);
        $user->email = $email;
        if (!$mapper->findOne()){
            $user->name = $name;
            $user->password = \System\Password::hash($password);
            $user->city = $city;
            $mapper->save();
            return $user->getId();
        }
        else{
            return false;
        }
    }
}
