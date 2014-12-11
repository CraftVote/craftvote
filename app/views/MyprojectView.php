<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyprojectView
 *
 * @author ishibkikh
 */
class MyprojectView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Мой проект');
        $this->pageHeader('Мой проект');
    }
}
