<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecoveryController
 *
 * @author ishibkikh
 */
class RecoveryController extends \System\Controller {
    
    public function get(){}
    
    public function post(){
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\PasswordRecovery());
        if ($input){
            $user = new \Models\Tables\Users();
            $mapper = new \DB\SQL\DataMapper($user);
            $user->email = $input['email'];
            if (!$mapper->findOne()){
                $ajax->ajax_red_alert('Указанный E-mail не зарегистрирован');
            }
            else{
                $plain = \System\Hasher::genRandom(5);
                $mail = new \Custom\SystemEmail($user->email, 'Восстановление пароля');
                $mail->template('password_recovery');
                $mail->set('username', $user->name);
                $mail->set('password', $plain);
                $mail->go();
                
                $user->clear();
                $user->password = \System\Password::hash($plain);
                $mapper->save();
                
                $ajax->ajax_popup('Успешно', 'На указанный E-mail выслан новый пароль');
            }
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return NULL;
    }
}
