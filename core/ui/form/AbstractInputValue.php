<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form;

/**
 * Description of InputValue
 *
 * @author Ivan
 */
abstract class AbstractInputValue extends AbstractElement {
    
    private $name, $value, $required = false, $validation = array(), $label, $disabled = false;
    
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setValue($val){
        $this->value = $val;
        return $this;
    }
    
    public function getValue(){
        return $this->value;
    }
    
    public function setRequired(){
        $this->required = true;
        return $this;
    }
    
    public function isRequired(){
        return $this->required;
    }
    
    public function setValidation($const, $param = null){
        $this->validation[] = array('type' => $const, 'param' => $param);
        return $this;
    }
    
    public function getValidationArray(){
        return $this->validation;
    }
    
    public function setLabel($text){
        $this->label = $text;
        return $this;
    }
    
    public function getLabel(){
        return $this->label;
    }
    
    public function disable(){
        $this->disabled = true;
    }
    
    public function enable(){
        $this->disabled = false;
    }
    
    public function isDisabled(){
        return $this->disabled;
    }
}
