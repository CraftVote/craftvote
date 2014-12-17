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
            $id = \Auth\Identity::registry($input['email'], $input['password'], $input['name'], $input['city']);
            \System\Session::stop();
            $hash = \System\Hasher::gen256($input['email']);
            $verify = new \Models\Tables\Verify();
            $mapper = new DB\MySQL\DataMapper($verify);
            $verify->hash = $hash;
            $verify->user_id = $id;
            $mapper->save();
            
            $mail = new \Custom\FromSystemEmail($input['email'], 'Регистрация на CRAFTVOTE.RU');
            $mail->template('email_verify');
            $mail->set('name', $input['name']);
            $mail->set('host', $_SERVER['SERVER_NAME']);
            $mail->set('hash', $hash);
            $mail->go();
            
            \Custom\Finance::fill($id, '30', 'бонус за регистрацию');
            
            $ajax->ajax_redirect("/auth/registry/success");
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return NULL;
    }
    
}
