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
        
        $config = \System\ApplicationRegistry::getConfig();
        $user = new \Models\Tables\Users();
        $dm = new \DB\MySQL\DataMapper($user);
        if (!$dm->findById(2)){
            echo 'No';
        }
        else{
            echo $user->name;
        }

        $this->close();
    }
    
    public function allowAccess() {
        return NULL;
    }
}
