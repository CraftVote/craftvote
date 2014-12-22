<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyprojectView
 *
 * @author ishibkikh
 */
class MyprojectsView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Мои проекты');
        $this->template('myprojects');
        $this->write('PROJECTS', $this->renderProjects($this->getParam('projects')));
    }
    
    protected function renderProjects($collection){
        
        if (count($collection) === 0){
            return '<p class="text-muted">Проекты еще не созданы</p>';
        }
        
        $table = new \UI\Table();
        $table->titles(['Название', 'Дата регистрации', 'Статус']);
        foreach ($collection as $row){
            $table->addRow([$this->renderTitle($row->title, $row->id), '<span class="time">'.$row->date_reg.'</span', $this->renderStatus($row->active)]);
        }
        return $table->getHtml();
    }
    
    protected function renderStatus($input){
        if ($input == 1){
            return '<small class="text-success">активен</small>';
        }
        else{
            return '<small class="text-danger">блокирован</small>';
        }
    }
    
    protected function renderTitle($title, $id){
        
        return '<a href="/project/'.$id.'">'.$title.'</a>';
    }
}
