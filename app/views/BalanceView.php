<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BalanceView
 *
 * @author ishibkikh
 */
class BalanceView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Баланс');
        $this->pageHeader('Баланс');
    }
}
