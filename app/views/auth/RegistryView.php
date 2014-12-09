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
class RegistryView extends \System\HtmlView {
    public function execute() {
        $this->layout("general");
        $this->title("Регистрация");
        $this->pageHeader('Регистрация');
        $form = new Models\Forms\Registry();
        $this->body($form->getHtml());
        
    }
}
