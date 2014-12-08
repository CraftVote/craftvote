<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Forms;

/**
 * Description of PasswordRecovery
 *
 * @author ishibkikh
 */
class PasswordRecovery extends \Form\AbstractModel {
    
    public function renderForm() {
        
        $this->name('recovery');
        $this->action('/auth/recovery');
        $this->setTitle('Восстановление пароля');
        $this->horizontal();
        $this->setLabelLen(3);
        $this->setFieldLen(5);
        
        $this->appendElement(new \UI\Email('email', 'E-mail', true));
        $this->appendElement(new \UI\Captcha('captcha', 'Код'));
        $this->appendHr();
        $this->appendButton(new \UI\Button\RecoveryButton());
    }
}
