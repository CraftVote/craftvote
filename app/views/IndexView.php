<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HelloworldView
 *
 * @author ishibkikh
 */
class IndexView extends \System\HtmlView {
    
    public function execute() {
        
        $time = $this->getParam('time');
        $this->layout('general');
        $this->title('Welcome');
        $this->pageHeader('HMVC Web Application');
        $this->p('Current time: '.$time);
    }
  
}
