<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form;

/**
 * Description of CheckBox
 *
 * @author ishibkikh
 */
class RadioGroup extends AbstractInputValue{
    
    private $items = array();
    
    public function __construct($name, $label, $required = false){
        $this->setName($name);
        $this->setLabel($label);
        if($required){$this->setRequired();}
        $this->setType(\Form\ElementTypes::RADIOGROUP);
    }
    
    public function isChecked(){
        return $this->checked;
    }
    
    public function appendItem($value, $title){
        $this->items[$value] = $title;
    }
    
    public function getItems(){
        return $this->items;
    }
    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'required' => $this->isRequired(),
            'validation' => $this->getValidationArray(),
            'type' => $this->getType(),
            'items' => $this->getItems(),
            'value' => $this->getValue(),
            'disabled' => $this->isDisabled()
        );
    }
    
    public function getHtml() {
        
        $at = new \Form\ConstructAttributes();
        $at->append('name', $this->getName());
        if ($this->isDisabled()){
            $at->append('disabled', null);
        }
        if ($this->isChecked()){
            $at->append('checked', null);
        }
        
        return '<div class="checkbox"><label><input type="checkbox" '.$at->render().'> '.$this->getTitle().'</label></div>';
    }
}
