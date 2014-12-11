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
    
    static public function login($username, $password){
        
        $user = new \Models\Tables\Users();
        $user->email = $username;
        $mapper = new \DB\MySQL\DataMapper($user);
        if (!$mapper->findOne()){
            return false;
        }
        if (!\System\Password::verify($password, $user->password)){
            return false;
        }
        if ($user->active === 0){
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
    
    
    static public function registry($email, $password, $name){
        
        $user = new \Models\Tables\Users();
        $mapper = new \DB\MySQL\DataMapper($user);
        $user->email = $email;
        if (!$mapper->find()){
            $user->name = $name;
            $user->password = \System\Password::hash($password);
            $mapper->save();
            return true;
        }
        else{
            return false;
        }
    }
}
