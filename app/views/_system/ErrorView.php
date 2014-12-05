<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorView
 *
 * @author Ivan
 */
class ErrorView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Ошибка');
        $this->h1('Что-то пошло не так :(');
        $this->p($this->getContextError());
        return true;
    }
}
