<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form;

/**
 * Description of SingleRowText
 *
 * @author Ivan
 */ 
class SingleRowText extends AbstractTextValue {
    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'required' => $this->isRequired(),
            'type' => $this->getType(),
            'minlen' => $this->getMinLen(),
            'maxlen' => $this->getMaxLen(),
            'placeholder' => $this->getPlaceholder(),
            'value' => $this->getValue(),
            'validation' => $this->getValidationArray(),
            'disabled' => $this->isDisabled()
        );
    }
    
    public function getHtml() {
        
        $at = new \Form\ConstructAttributes();
        $at->append('name', $this->getName());
        if ($this->getPlaceholder() !== null){
            $at->append('placeholder', $this->getPlaceholder());
        }
        $at->append('value', $this->getValue());
        $at->append('maxlength', $this->getMaxLen());
        if ($this->isDisabled()){
            $at->append('disabled', null);
        }
        if ($this->getType() === \Form\ElementTypes::PASSWORD){
            $at->append('type', 'password');
        }
        else{
            $at->append('type', 'text');
        }
        
        return '<input class="form-control" '.$at->render().'>';
    }
    
    public function __construct($name, $label, $required = false, $placeholder = null) {
        $this->setName($name);
        $this->setMinLen(4);
        $this->setMaxLen(256);
        $this->setLabel($label);
        $this->setType(\Form\ElementTypes::INPUT_TEXT);
        if ($required){
            $this->setRequired();
        }
        if ($placeholder !== null){
            $this->setPlaceholder($placeholder);
        }
    }
}
