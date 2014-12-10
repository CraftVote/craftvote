<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthView
 *
 * @author Ivan
 */
class AuthView extends \System\View {
    
    public function execute() {
        $menu = new \UI\Menu('CRAFT<b class="text-info">VOTE</b>.RU');
        $menu->activeButton(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
        $menu->addLeftButton('Новости', '/news');
        $menu->addLeftButton('О нас', '/about');
        $menu->addLeftButton('Контакты', '/contacts');
        $items = array(
            'Профиль'=>'/profile/'.\Auth\User::getId(),
            'Мой проект'=>'/myproject',
            'Мои новости'=>'/mynews',
            'Реклама'=>'/adv',
            'Настройки'=>'/settings',
            'Смена пароля'=>'/chpass',
            'divider' => NULL,
            '<span title="Выйти" class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выйти'=>'/auth/logout'
        );
        $menu->addRightButton('<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 0', '#');
        $menu->addRightButton('<span class="glyphicon glyphicon-usd" aria-hidden="true"></span> 0', '#');
        $menu->addRightDropdown('<span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.\Auth\User::getName().' <span class="label label-info">Admin</span>', $items);
        $this->body($menu->getHtml());
    }
}
