<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Forms;

/**
 * Description of CreateProject
 *
 * @author ishibkikh
 */
class EditProject extends \Form\AbstractModel {
    
    protected $project_id;
    
    public function __construct($project_id) {
        parent::__construct('project', '/project/edit/'.$project_id);
        $this->setTitle('Редактирование проекта');
        $this->setLabelLen(3);
        $this->project_id = $project_id;
    }

    public function renderForm() {
        
        $title = new \UI\Form\SingleRowText('title', 'Название проекта', true);
        $title->setMaxLen(64);
        $this->appendElement($title);
        $description = new \UI\Form\MultipleRowsText('description', 'Описание', false, 'не обязательно');
        $description->setMaxLen(512);
        $this->appendElement($description);
        $this->appendElement(new \UI\Form\SingleRowText('website', 'Вебсайт', false, 'не обязательно'));
        $this->appendElement(new \UI\Form\SingleRowText('sn', 'Группа в соц.сети', false, 'не обязательно'));
        $this->appendElement(new \UI\Form\Captcha('captcha', 'Код с картинки'));
        $this->appendHr();
        $this->appendButton(new \UI\Form\Button\SaveButton());
        $this->appendButton(new \UI\Form\Button\CancelButton('/project/'.$this->project_id.'/info'));
    }
}
