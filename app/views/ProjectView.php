<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectView
 *
 * @author ishibkikh
 */
class ProjectView extends \System\View {
    
    public function execute() {
        
        $this->layout('general');
        $this->template('project');
        $this->renderProject($this->getParam('project'));
    }
    
    protected function renderProject($project){
        
        $this->title($project['title']);
        if ($project['logo'] == NULL){
            $this->write('LOGO', 'default.png');
        }
        else{
            $this->write('LOGO', $project['logo']);
        }
        if ($project['website'] == NULL){
            $this->write('WEBSITE', 'отсутствует');
        }
        else{
            $this->write('WEBSITE', $project['website']);
        }
        if ($project['sn'] == NULL){
            $this->write('SN', 'отсутствует');
        }
        else{
            $this->write('SN', $project['sn']);
        }
        $this->write('DESC', $project['description']);
        $this->write('REG', $project['date_reg']);
        $this->write('USER_ID', $project['user_id']);
        $this->write('USER_NAME', $project['name']);
    }
}
