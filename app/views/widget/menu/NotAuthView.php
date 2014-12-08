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
        $menu = new \UI\Menu('CraftVote');
        $menu->activeButton(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
        $menu->addLeftButton('Новости проекта', '/news');
        $menu->addLeftButton('Регистрация', '/auth/register');
        $menu->addRightButton('<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Войти', '#', 'Modal.loadForm(\'/auth/form\');return false;');
        $this->body($menu->getHtml());
    }
}
