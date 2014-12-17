<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SuccessView
 *
 * @author Ivan
 */
class SuccessView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Подтверждение E-mail');
        $this->pageHeader('Подтверждение E-mail');
        $this->body('<h4 class="text-success"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> E-mail подтверждён</h4><br>');
        $this->p('Поздравляем! Теперь вы полноценный пользователь нашего сайта и можете авторизоваться');
        $this->body('<div class="alert alert-info" role="alert"><strong>Бонус</strong> Мы зачислили ещё 30 рублей на ваш виртуальный счёт</div>');
    }
}
