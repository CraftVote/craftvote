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
        $title->setValue($this->getValue('title'));
        $this->appendElement($title);
        $description = new \UI\Form\MultipleRowsText('description', 'Описание', false, 'не обязательно');
        $description->setMaxLen(512);
        $description->setValue($this->getValue('description'));
        $this->appendElement($description);
        $website = new \UI\Form\SingleRowText('website', 'Вебсайт', false, 'не обязательно');
        $website->setValue($this->getValue('website'));
        $this->appendElement($website);
        $sn = new \UI\Form\SingleRowText('sn', 'Группа в соц.сети', false, 'не обязательно');
        $sn->setValue($this->getValue('sn'));
        $this->appendElement($sn);
        $this->appendElement(new \UI\Form\Captcha('captcha', 'Код с картинки'));
        $this->appendHr();
        $this->appendButton(new \UI\Form\Button\SaveButton());
        $this->appendButton(new \UI\Form\Button\CancelButton('/project/'.$this->project_id.'/info'));
    }
}
