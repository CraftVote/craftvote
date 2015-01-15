<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form\Button;

/**
 * Description of SubmitButton
 *
 * @author Ivan
 */
class RecoveryButton extends AbstractButton  {
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('Восстановить');
        $this->setRedColor();
        $this->submit();
    }
}
