<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Models\Forms;
/**
 * Description of LoginForm
 *
 * @author ishibkikh
 */

class Login extends \Form\AbstractModel {
    

    public function renderForm()
    {
        $this->name('login');
        $this->action('/auth/login');
        $this->horizontal();
        $this->setTitle('Авторизация');
        $this->setLabelLen(1)->setFieldLen(10);
        
        $email = new \UI\Email('email', '', true);
        $email->setPlaceholder('E-mail');
        $this->appendElement($email);
        $password = new \UI\Password('password', '');
        $password->setPlaceholder('Пароль');
        $this->appendElement($password);
        $this->appendElement(new \UI\StaticText('', '<small class="pull-right"><a href="/auth/recovery">Забыли пароль?</a></small>'));
        $this->appendButton(new \UI\Button\LoginButton());
    }
}
