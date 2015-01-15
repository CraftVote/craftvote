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
        $this->write('NAV', $this->getParam('NAV'));
    }
    
    protected function renderProject($project){
        
        $this->title($project['title']);
        if ($project['logo'] == NULL){
            $this->write('LOGO', 'default.png');
        }
        else{
            $this->write('LOGO', $project['logo']);
        }
        $this->write('DESC', $project['description']);
        $this->write('VOTES', $project['votes']);
        $this->write('VISITS', $project['visits']);
        $this->write('ID', $project['id']);
        $this->write('REG', $project['date_reg']);
        $this->write('RATING', $project['rating']);
    }
}
