<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Textarea
 *
 * @author ishibkikh
 */
class MultipleRowsText extends AbstractTextValue{
    
    private $rows = 7;
    
    public function setRows($int){
        $this->rows = $int;
        return $this;
    }
    
    public function getRows(){
        return $this->rows;
    }

    public function __construct($name, $label, $required = false) {
        $this->setName($name);
        $this->setLabel($label);
        if ($required){
            $this->setRequired();
        }
        $this->setType(\Form\ElementTypes::TEXTAREA);
        $this->setMaxLen(4096);
    }    
    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'required' => $this->isRequired(),
            'type' => $this->getType(),
            'placeholder' => $this->getPlaceholder(),
            'minlen' => $this->getMinLen(),
            'maxlen' => $this->getMaxLen(),
            'value' => $this->getValue(),
            'validation' => $this->getValidationArray(),
            'rows' => $this->getRows(),
            'disabled' => $this->isDisabled()
        );
    }
    
    public function getHtml() {
        
        $at = new \Form\ConstructAttributes();
        $at->append('name', $this->getName());
        $at->append('maxlength', $this->getMaxLen());
        if ($this->isDisabled()){
            $at->append('disabled', 'disabled');
        }
        if ($this->getPlaceholder() !== null){
            $at->append('placeholder', $this->getPlaceholder());
        }
        $at->append('rows', $this->getRows());
        
        return '<textarea class="form-control" '.$at->render().'>'.$this->getValue().'</textarea>';
    }
    
}
