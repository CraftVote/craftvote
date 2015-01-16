<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditController
 *
 * @author ishibkikh
 */
class EditController extends \System\Controller {
    
    public function get($id){
        $project = new \Custom\Project();
        $result = $project->getByProjectId($id);
        if (!$result){
            $this->pageNotFound();
            return;
        }
        if ($result['user_id'] !== \Auth\User::getId()){
            $this->setError('Доступ закрыт');
            return;
        }
        $this->setParam('project', $result);
    }
    
    
    public function post($input_id){
        $id = intval($input_id);
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\EditProject($id));
        if ($input !== FALSE){
            $project = new \Models\Tables\Projects();
            $mapper = new \DB\MySQL\DataMapper($project);
            if (!$mapper->findById($id)){
                $ajax->ajax_red_alert('Проект не найден');
                $this->setAjax($ajax);
                return;
            }
            if ($project->user_id !== \Auth\User::getId()){
                $ajax->ajax_red_alert('Попытка редактирования чужого проекта');
                $this->setAjax($ajax);
                return;
            }
            $project->title = $input['title'];
            $project->description = $input['description'];
            $project->website = \System\URL::format($input['website']);
            $project->sn = \System\URL::format($input['sn']);
            $mapper->save();
            $ajax->ajax_green_alert('Сохранено');
        }
        $this->setAjax($ajax);
    }

    
    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
}