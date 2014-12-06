<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisterView
 *
 * @author Anonymous
 */
class RegisterView extends \System\HtmlView {
    public function execute() {
        $this->layout("general");
        $this->title("Регистрация");
        $form = new Models\Forms\Register();
        $this->body($form->getHtml());
        
    }
}
