<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of StaticText
 *
 * @author ishibkikh
 */
class StaticText extends AbstractInputValue{
    
    public function __construct($label, $text) {
        $this->setLabel($label);
        $this->setValue($text);
        $this->setType(\Form\ElementTypes::STATIC_TEXT);
    }


    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'validation' => $this->getValidationArray()
        );
    }
    
    public function getHtml() {
        return '<p class="form-control-static">'.$this->getValue().'</p>';
    }
}
