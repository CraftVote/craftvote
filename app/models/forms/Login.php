<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Models\Form;
/**
 * Description of LoginForm
 *
 * @author ishibkikh
 */

class LoginForm extends \Form\AbstractModel {
    

    public function renderForm()
    {
        $this->name('login');
        $this->action('/auth/login/post');
        $this->horizontal();
        $this->setTitle('Авторизация');
        $this->setLabelLen(2)->setFieldLen(9);
        
        $this->appendElement(new \UI\Email('email', 'E-mail', true));
        $this->appendElement(new \UI\Password('password', 'Пароль'));
        $this->appendElement(new \UI\SocialNetworksAuth('http://'.$_SERVER['HTTP_HOST'].'/auth/sn'));
        $this->appendButton(new \UI\Button\LoginButton());
    }
}
