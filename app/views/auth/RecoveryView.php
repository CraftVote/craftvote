<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecoveryView
 *
 * @author ishibkikh
 */
class RecoveryView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Восстановление пароля');
        $this->pageHeader('Восстановление пароля');
        $form = new \Models\Forms\PasswordRecovery();
        $this->body($form->getHtml());
    }
}
