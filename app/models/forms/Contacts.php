<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Models\Forms;
/**
 * Description of contacts
 *
 * @author Anonymous
 */
class Contacts extends \Form\AbstractModel {
    
    public function __construct() {
        parent::__construct('contacts', '/contacts');
    }

    public function renderForm() {
        $this->setTitle("Контакты");     
        $this->setLabelLen(3)->setFieldLen(5);
        
        $this->appendElement(new \UI\SingleRowText('name', 'Ваше имя', true));
        $email = new \UI\Email('email', 'E-mail', true);
        $email->setValidation(\Form\ElementValidations::DB_UNIQUE_FIELD, array("users","email"));
        $this->appendElement($email);
        $this->appendElement(new \UI\Captcha('captcha', 'Код'));
        $this->appendHr();
        $this->appendButton(new \UI\Button\RegistryButton());        
    }
}
       
