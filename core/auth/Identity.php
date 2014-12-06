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
        $mapper = new \DB\SQL\DataMapper($user);
        if (!$mapper->findOne()){
            return false;
        }
        if (!\System\Password::verify($password, $user->password)){
            return false;
        }
        if ($user->active === 0){
            return false;
        }

        \Auth\User::registry($user);
        $user->clear();
        $user->session = \Auth\User::getSessionHash();
        //$mapper->save();
        return true;
    }
    
    
    static public function logout(){
        \Auth\User::unregistry();
    }
    
    
    static public function registry($email, $password, $fullname, $role){
        
        $user = new \DbTable\Users();
        $mapper = new \DB\SQL\DataMapper($user);
        $user->email = $email;
        if (!$mapper->find()){
            $user->fullname = $fullname;
            $user->role = $role;
            $user->password = \System\Password::hash($password);
            $mapper->save();
            return true;
        }
        else{
            return false;
        }
    }
}
