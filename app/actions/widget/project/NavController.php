<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InfoController
 *
 * @author ishibkikh
 */
class NavController extends \System\Controller {
    
    public function get($action, $id){
        
        $project = new \Custom\Project();
        $result = $project->getByProjectId(intval($id));
        if (!$result){
            $this->pageNotFound();
        }
        else{
            $this->setParam('project', $result);
            switch ($action){
                case 'info':
                    $this->moveTo('widget project '.$action);
                    break;
                case 'servers':
                    $this->moveTo('widget project '.$action);
                    break;
                case 'comments':
                    $this->moveTo('widget project '.$action);
                    break;
                default : $this->pageNotFound();
            }
        }
    }
    
    public function allowAccess() {
        return NULL;
    }
}
