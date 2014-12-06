<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Password
 *
 * @author Ivan
 */
class Password extends SingleRowText {
    
    public function setEqualField($field){
        $this->setValidation(\Form\ElementValidations::EQUALFIELD, $field);
    }
      
    public function __construct($name, $label) {
        parent::__construct($name, $label);
        $this->setName($name);
        $this->setLabel($label);
        $this->setMaxLen(64);
        $this->setMinLen(5);
        $this->setRequired();
        $this->setType(\Form\ElementTypes::PASSWORD);
    }
}
