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
    
    public function get($id){
        
        $project = new \Custom\Project();
        $result = $project->getByProjectId(intval($id));
        if (!$result){
            $this->pageNotFound();
        }
        else{
            $this->setParam('project', $result);
            if (\Auth\User::isAuth()){
                if ($result['user_id'] !== \Auth\User::getId()){
                    \Custom\Project::increaseVisits($result['id']);
                }
            }
            else{
                \Custom\Project::increaseVisits($result['id']);
            }
            
        }
    }
    
    public function allowAccess() {
        return NULL;
    }
}
