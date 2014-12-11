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
            '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Мой профиль'=>'/profile/'.\Auth\User::getId(),
            '<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Мой проект'=>'/myproject',
            '<span class="glyphicon glyphicon-send" aria-hidden="true"></span> Мои новости'=>'/mynews',
            '<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Моя реклама'=>'/myadv',
            '1' => 'divider',
            '<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Управление сайтом'=>'/manage',
            '<span class="glyphicon glyphicon-qrcode" aria-hidden="true"></span> Смена пароля'=>'/chpass',
            '0' => 'divider',
            '<span title="Выйти" class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выйти'=>'/auth/logout'
        );
        $menu->addRightButton('<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 0', '/mail');
        $menu->addRightButton('<span class="glyphicon glyphicon-usd" aria-hidden="true"></span> 0', '/balance');
        $menu->addRightDropdown('<span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.\Auth\User::getName().' <span class="label label-info">Admin</span>', $items);
        $this->body($menu->getHtml());
    }
}
