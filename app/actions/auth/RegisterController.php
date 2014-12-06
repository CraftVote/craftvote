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
        $ajax = new \System\
       $input = $this->ajax_validate_form(new \Models\Form\Register());
        if($input){
            $user = new \Models\Tables\Users();
            $user->assignFromArray($input);
            $dm = new \DB\SQL\DataMapper($user);
            $dm->save();
            $this->ajax_redirect("/");
        } 
    }
    
    public function allowAccess() {
        return NULL;
    }
    
}
