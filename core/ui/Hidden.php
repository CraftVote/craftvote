<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Hidden
 *
 * @author ishibkikh
 */
class Hidden extends AbstractInputValue {
    
    public function __construct($name, $value) {
        $this->setName($name);
        $this->setValue($value);
        $this->setType(\Form\ElementTypes::HIDDEN);
    }

    public function getHtml() {
        return '<input type="hidden" name="'.$this->getName().'" value="'.$this->getValue().'">';
    }
    
    public function getArray() {
        return array(
            'label' => null,
            'required' => true,
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'validation' => $this->getValidationArray()
        );
    }
}
