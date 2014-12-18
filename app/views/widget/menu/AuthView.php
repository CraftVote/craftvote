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
            '<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Мои проекты'=>'/myprojects',
            '<i class="fa fa-bullhorn"></i> Моя реклама'=>'/myadv',
            '1' => 'divider',
            '<i class="fa fa-cogs"></i> Управление сайтом'=>'/manage',
            '<i class="fa fa-key"></i> Смена пароля'=>'/chpass',
            '0' => 'divider',
            '<span title="Выйти" class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выйти'=>'/auth/logout'
        );
        $menu->addRightButton('<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 0', '/mail');
        $menu->addRightButton('<i class="fa fa-rub"></i> '. \Custom\Finance::getAgregatedBalance(\Auth\User::getId()), '/balance');
        $menu->addRightDropdown('<span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.\Auth\User::getName().' <span class="label label-info">Admin</span>', $items);
        $this->body($menu->getHtml());
    }
}
