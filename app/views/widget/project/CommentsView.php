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
class CommentsView extends \System\View {
    
    public function execute() {
        
        $project = $this->getParam('project');
        
        $nav = new \UI\Navtabs();
        $nav->append('Основная информация', '/project/'.$project['id'].'/info');
        $nav->append('Сервера', '/project/'.$project['id'].'/servers');
        $nav->append('Отзывы', null, true);
        $nav->body('<h4>Отзывы</h4>');
        $this->body($nav->toHtml());
    }
}
