<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author Ivan
 */
class LoginController extends \System\Controller {
    
    public function post(){
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\Login());
        if ($input){
            if (\Auth\Identity::login($input['email'], $input['password'])){
                $ajax->ajax_redirect('/profile/'.\Auth\User::getId());
            }
            else{
                $ajax->ajax_red_alert(\Auth\Identity::$error);
            }
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return NULL;
    }
}
