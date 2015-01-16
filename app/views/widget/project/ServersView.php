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
        //$nav->append('Отзывы', '/project/'.$project['id'].'/comments');
        if ($project['user_id'] === \Auth\User::getId()){
            $button = '<button onclick="Modal.loadForm(\'/project/servers/new/'.$project['id'].'\');" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить</button>';
        }
        else{
            $button = '';
        }
        $nav->body('<div class="row"><div class="col-sm-8"><h4>Сервера</h4></div><div class="col-sm-4 text-right">'.$button.'</div></div>'.$this->renderServers($project['id']));
        $this->body($nav->toHtml());
    }
    
    protected function renderServers($project_id){
        
        $servers = new \Models\Tables\Servers();
        $mapper = new \DB\MySQL\DataMapper($servers);
        $servers->project_id = intval($project_id);
        $result = $mapper->findAll();
        if (count($result) == 0){
            return '<p class="text-muted"><small>Отсутствуют</small></p>';
        }
        else{
            $table = new \UI\Table();
            $table->striped();
            $table->bordered();
            $table->titles(array('Название', 'Версия', 'Адрес', 'Клиент', 'White List', 'PvP', 'Players', 'Online'));
            foreach ($result as $item){
                $table->addRow(array($item->title, $item->version, $item->host, $item->client, $this->renderBoolean($item->wlist), $this->renderBoolean($item->pvp), $item->players, $this->renderBoolean($item->active)));
            }
            return $table->getHtml();
        }
    }
    
    protected function renderBoolean($input){
        
        if ($input == 1){
            return 'да';
        }
        else {
            return 'нет';
        }
    }
}
