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
class SendButton extends AbstractButton  {
    
    public function __construct() {
        parent::__construct();
        $this->setTitle('Отправить');
        $this->setBlueColor();
        $this->submit();
    }
}
