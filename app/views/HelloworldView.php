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
class HelloworldView extends \System\HtmlView {
    
    public function execute() {
        
        $this->layout('general');
        $this->title('Hello world!');
        $time = $this->getParam('time');
        $this->h1('This is my first Web Application');
        $this->p('Current time: '.$time);
    }
  
}
