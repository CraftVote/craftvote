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
class Page404View extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Страница не найдена');
        $this->h1('Страница не найдена');
        $this->h4(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
        $this->p('Возможно страница была изменена или удалена');
    }
}
