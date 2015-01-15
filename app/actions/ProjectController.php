<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectController
 *
 * @author ishibkikh
 */
class ProjectController extends \System\Controller {
    
    public function get($id, $action){
        
        $project = new \Custom\Project();
        $result = $project->getByProjectId(intval($id));
        if (!$result){
            $this->pageNotFound();
        }
        else{
            $this->setParam('project', $result);
            if (\Auth\User::isAuth()){
                if ( ($result['user_id'] !== \Auth\User::getId()) and ($action === 'info') ){
                    \Custom\Project::increaseVisits($result['id']);
                }
            }
            else{
                if ($action === 'info'){
                    \Custom\Project::increaseVisits($result['id']);
                }
            }
            $widget = new \System\Service('/widget/project/nav/'.$action.'/'.$id);
            if ($widget->getResponseCode() === 404){
                $this->pageNotFound();
                return;
            }
            $this->setParam('NAV', $widget->getContent());
        }
    }
    
    public function allowAccess() {
        return NULL;
    }
}
