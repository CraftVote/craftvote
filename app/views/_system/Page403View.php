<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error404View
 *
 * @author Ivan
 */
class Page403View extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Доступ закрыт');
        $this->h1('Доступ закрыт');
        $this->p('Вы не имеете прав для просмотра этой страницы');
    }
}
