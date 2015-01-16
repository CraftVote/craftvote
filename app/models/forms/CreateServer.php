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
class CreateServer extends \Form\AbstractModel {
    
    public function __construct($project_id) {
        parent::__construct('project', '/project/servers/create/'.$project_id);
        $this->setTitle('Создание сервера');
        $this->setLabelLen(3);
        $this->setFieldLen(9);
    }

    public function renderForm() {
        
        $title = new \UI\Form\SingleRowText('title', 'Название', true);
        $title->setMaxLen(128);
        $this->appendElement($title);
        
        $host = new \UI\Form\SingleRowText('host', 'Адрес', true);
        $host->setMaxLen(64);
        $this->appendElement($host);
        
        $version = new \UI\Form\SingleRowText('version', 'Версия', true);
        $version->setMaxLen(32);
        $version->setMinLen(1);
        $this->appendElement($version);
        
        $client = new \UI\Form\DropDownList('client', 'Клиент', true);
        $client->appendItem('свой', 'свой');
        $client->appendItem('лицензия', 'лицензия');
        $client->appendItem('пиратка', 'пиратка');
        $this->appendElement($client);
        
        $this->appendElement(new \UI\Form\CheckBox('wlist', 'White List', 'используется', false));
        $this->appendElement(new \UI\Form\CheckBox('pvp', 'PvP', 'разрешено убивать игроков', false));
        
        $this->appendElement(new \UI\Form\Captcha('captcha', 'Код с картинки'));
        $this->appendHr();
        $this->appendButton(new \UI\Form\Button\CreateButton());
    }
}
