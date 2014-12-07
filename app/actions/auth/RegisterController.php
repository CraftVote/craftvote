<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterController
 *
 * @author Anonymous
 */
class RegisterController extends \System\Controller {
    public function get(){
       
    }
    
    public function post(){
        
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\Register());
        if($input){
            $user = new \Models\Tables\Users();
            $user->assignFromArray($input);
            $user->password = \System\Password::hash($user->password);
            $dm = new \DB\SQL\DataMapper($user);
            $dm->save();
            $ajax->ajax_redirect("/");
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return NULL;
    }
    
}
