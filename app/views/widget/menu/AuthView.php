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
        $menu = new \UI\Menu('CraftVote');
        $menu->activeButton(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING));
        $menu->addLeftButton('Новости проекта', '/news');
        $items = array(
            'Профиль'=>'/profile',
            'Сменить пароль'=>'/chpass',
            'divider' => NULL,
            '<span title="Выйти" class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выйти'=>'/auth/logout'
        );
        $menu->addRightDropdown('<span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.\Auth\User::getName(), $items);
        $this->body($menu->getHtml());
    }
}
