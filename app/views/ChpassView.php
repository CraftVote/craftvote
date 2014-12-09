<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChpassView
 *
 * @author ishibkikh
 */
class ChpassView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Смена пароля');
        $this->pageHeader('Смена пароля');
    }
}
