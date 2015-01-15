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
class CreateProject extends \Form\AbstractModel {
    
    public function __construct() {
        parent::__construct('project', '/myprojects/new');
        $this->setTitle('Создание проекта');
        $this->setLabelLen(3);
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
        $this->appendButton(new \UI\Form\Button\CreateButton());
    }
}
