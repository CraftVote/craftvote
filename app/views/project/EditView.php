<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditView
 *
 * @author ishibkikh
 */
class EditView extends \System\HtmlView{
    
    public function execute() {
        $this->layout('general');
        $project = $this->getParam('project');
        $this->title($project['title']);
        $this->pageHeader('Редактирование проекта');
        $form = new \Models\Forms\EditProject($project['id']);
        $form->setValue('title', $project['title']);
        $form->setValue('description', $project['description']);
        $form->setValue('website', $project['website']);
        $form->setValue('sn', $project['sn']);
        $this->body($form->getHtml());
    }
}
