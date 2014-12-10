<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotAuthView
 *
 * @author Ivan
 */
class NotauthView extends \System\View {
    
    public function execute() {
        $menu = new \UI\Menu('CRAFT<b class="text-info">VOTE</b>.RU');
        $menu->activeButton(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
        $menu->addLeftButton('Новости', '/news');
        $menu->addLeftButton('О нас', '/about');
        $menu->addLeftButton('Контакты', '/contacts');
        $menu->addRightButton('Регистрация', '/auth/registry');
        $menu->addRightButton('<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Войти', '#', 'Modal.loadForm(\'/auth/form\');return false;');
        $this->body($menu->getHtml());
    }
}
