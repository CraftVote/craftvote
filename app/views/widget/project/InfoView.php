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
class InfoView extends \System\View {
    
    public function execute() {
        
        $project = $this->getParam('project');
        
        $nav = new \UI\Navtabs();
        $nav->append('Основная информация', null, true);
        $nav->append('Сервера', '/project/'.$project['id'].'/servers');
        $nav->append('Отзывы', '/project/'.$project['id'].'/comments');
        $nav->body('<table>
                        <tr>
                            <td><p><small class="text-muted">Владелец</small></p></td>
                            <td class="padding-left"><p><small><a href="/profile/'.$project['user_id'].'">'.$project['name'].'</a></small></p></td>
                        </tr>
                        <tr>
                            <td><p><small class="text-muted">Вебсайт</small></p></td>
                            <td class="padding-left"><p><small><a target="_blank" href="'.$project['website'].'">'.$project['website'].'</a></small></p></td>
                        </tr>
                        <tr>
                            <td><p><small class="text-muted">Группа в соцсети</small></p></td>
                            <td class="padding-left"><p><small><a target="_blank" href="'.$project['sn'].'">'.$project['sn'].'</a></small></p></td>
                        </tr>
                    </table>');
        
        $this->body($nav->toHtml());
    }
}
