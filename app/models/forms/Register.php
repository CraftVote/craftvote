<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Models\Forms;
/**
 * Description of Register
 *
 * @author Anonymous
 */
class Register extends \Form\AbstractModel {
    public function renderForm() {
        $this->name("register");
        $this->action('/auth/register');
        $this->horizontal();
        $this->setTitle("Регистрация");
        $this->setLabelLen(2)->setFieldLen(5);
        
        $this->appendElement(new \UI\SingleRowText('name', 'Ваше имя', true));
        $this->appendElement(new \UI\Email('email', 'E-mail', true));
        $this->appendElement(new \UI\Password('password', 'Пароль'));
        $this->appendButton(new \UI\Button\LoginButton());        
    }
}
