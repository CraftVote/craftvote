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
class RegistryController extends \System\Controller {
    public function get(){}
    
    public function post(){
        
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\Registry());
        if($input){
            \Auth\Identity::registry($input['email'], $input['password'], $input['name']);
            \System\Session::stop();
            $ajax->ajax_redirect("/");
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return NULL;
    }
    
}
