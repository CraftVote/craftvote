<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactsController
 *
 * @author ishibkikh
 */
class ContactsController extends \System\Controller {
    
    public function get(){}
    
    public function post(){
        
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\Contacts());
        if($input){
            
            if (!\Auth\User::isAuth()){
                $mail = new \Custom\UserToSystemEmail($input['email'], $input['topic'], $input['name'], $input['message']);
            }
            else{
                $mail = new \Custom\UserToSystemEmail(\Auth\User::getEmail(), $input['topic'], \Auth\User::getName(), $input['message']);
            }
            $mail->go();
            $ajax->ajax_popup('Отправлено', "Ваше сообщение успешно отправлено. В ближайшее время мы на него ответим!");
            $ajax->clearForm('contacts');
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return NULL;
    }
}
