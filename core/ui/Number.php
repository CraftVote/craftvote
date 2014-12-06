<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Number
 *
 * @author Ivan
 */
class Number extends SingleRowText {
    
    public function __construct($name, $label, $required = false) {
        parent::__construct($name, $label, $required);
        $this->setValidation(\Form\ElementValidations::NUMBER);
    }
}
