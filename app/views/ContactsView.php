<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactsView
 *
 * @author ishibkikh
 */
class ContactsView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Контакты');
        $this->pageHeader('Контакты');
        $this->template('contacts');
    }
    
}
