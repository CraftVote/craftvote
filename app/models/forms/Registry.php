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
class Registry extends \Form\AbstractModel {
    
    public function __construct() {
        parent::__construct('registry', '/auth/registry');
    }

    public function renderForm() {
        $this->setTitle("Регистрация");
        $this->setLabelLen(3)->setFieldLen(5);
        
        $this->appendElement(new \UI\Form\SingleRowText('name', 'Фамилия Имя', true));
        $this->appendElement(new \UI\Form\SingleRowText('city', 'Город', true));
        $email = new \UI\Form\Email('email', 'E-mail', true);
        $email->setValidation(\Form\ElementValidations::DB_UNIQUE_FIELD, array("users","email"));
        $email->setPlaceholder('Необходимо будет подтвердить');
        $this->appendElement($email);
        $this->appendHr();
        $this->appendElement(new \UI\Form\Password('password', 'Придумайте пароль'));
        $pass = new \UI\Form\Password('repassword', 'Повторите пароль');
        $pass->setEqualField("password");
        $this->appendElement($pass);
        $this->appendHr();
        $this->appendElement(new \UI\Form\Captcha('captcha', 'Код с картинки'));
        $this->appendHr();
        $this->appendButton(new \UI\Form\Button\RegistryButton());        
    }
}
