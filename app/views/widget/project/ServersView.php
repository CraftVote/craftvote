<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InfoView
 *
 * @author ishibkikh
 */
class ServersView extends \System\View {
    
    public function execute() {
        
        $project = $this->getParam('project');
        
        $nav = new \UI\Navtabs();
        $nav->append('Основная информация', '/project/'.$project['id'].'/info');
        $nav->append('Сервера', null, true);
        $nav->append('Отзывы', '/project/'.$project['id'].'/comments');
        $nav->body('<h4>Сервера</h4>');
        $this->body($nav->toHtml());
    }
}
