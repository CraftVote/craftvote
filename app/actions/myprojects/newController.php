<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newController
 *
 * @author ishibkikh
 */
class newController extends \System\Controller {
    
    public function get(){}
    
    public function post(){
        $ajax = new \System\Ajax();
        $input = $ajax->ajax_validate_form(new \Models\Forms\CreateProject());
        if ($input !== false){
            $project = new \Models\Tables\Projects();
            $mapper = new \DB\MySQL\DataMapper($project);
            $project->user_id = \Auth\User::getId();
            $project->title = $input['title'];
            $project->description = $input['description'];
            $project->sn = \System\URL::format($input['sn']);
            $project->website = \System\URL::format($input['website']);
            $mapper->save();
            $ajax->ajax_redirect('/myprojects');
        }
        $this->setAjax($ajax);
    }

    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
}
