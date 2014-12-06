<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Button;

/**
 * Description of SubmitButton
 *
 * @author Ivan
 */
class CancelButton extends AbstractButton {
    
    public function __construct($link) {
        parent::__construct();
        $this->setTitle('Отмена');
        $this->setLink($link);
    }
}
