<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewView
 *
 * @author ishibkikh
 */
class NewView extends \System\HtmlView {
    
    public function execute() {
        
        $this->layout('general');
        $this->title('Создание проекта');
        $this->pageHeader('Создание проекта');
        $form = new \Models\Forms\CreateProject();
        $this->body($form);
    }
}
