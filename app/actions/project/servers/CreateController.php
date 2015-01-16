<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewController
 *
 * @author ishibkikh
 */
class CreateController extends \System\Controller {
    
    public function post($id){
        
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\CreateServer($id));
        
        if ($input !== FALSE){
            
            $project = new \Models\Tables\Projects();
            $mapper = new \DB\MySQL\DataMapper($project);
            if (!$mapper->findById($id)){
                $ajax->ajax_red_alert('Во время выполнения произошла внутренняя ошибка сервера - проект не найден');
                $this->setAjax($ajax);
                return;
            }
            if ($project->user_id !== \Auth\User::getId()){
                $ajax->ajax_red_alert('Во время выполнения произошла внутренняя ошибка сервера - проект не ваш');
                $this->setAjax($ajax);
                return;
            }
            $server = new \Models\Tables\Servers();
            $mapper_s = new \DB\MySQL\DataMapper($server);
            $server->host = $input['host'];
            $result = $mapper_s->findAll();
            if (count($result) > 0){
                $ajax->ajax_form_error('host', 'Этот адрес уже занят');
                $this->setAjax($ajax);
                return;
            }
            else{
                $server->assignFromArray($input);
                $server->project_id = intval($id);
                $mapper_s->save();
                $ajax->ajax_refresh();
            }
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
}
