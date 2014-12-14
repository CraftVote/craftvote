<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DebugController
 *
 * @author ishibkikh
 */
class DebugController extends \System\Controller{
    
    public function get(){
        
        $user = new \Models\Tables\Users();
        $mapper = new \DB\MySQL\DataMapper($user);
        $user->email = $email;
        $user->name = $name;
        $user->password = \System\Password::hash($password);
        $mapper->save();

        $this->close();
    }
    
    public function allowAccess() {
        return NULL;
    }
}
