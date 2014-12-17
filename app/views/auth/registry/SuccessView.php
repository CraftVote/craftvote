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
        $this->title('Регистрация');
        $this->pageHeader('Регистрация');
        $this->body('<h4 class="text-success"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Вы успешно зарегестированы</h4><br>');
        $this->p('Поздравляем! Вы сделали первый шаг вместе с CraftVote, но чтобы авторизоваться, вам необходимо последовать инструкции, которая отправлена на указанный вами E-mail');
        $this->body('<div class="alert alert-info" role="alert"><strong>Бонус</strong> Мы зачислили 30 рублей на ваш виртуальный счёт</div>');
    }
}
