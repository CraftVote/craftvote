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
class CheckBox extends AbstractInputValue{
    
    private $title, $checked = false;
    
    public function __construct($name, $label, $title, $checked = false){
        $this->setName($name);
        $this->setLabel($label);
        $this->setTitle($title);
        if ($checked){
            $this->check();
        }
        $this->setType(\Form\ElementTypes::CHECKBOX);
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function check(){
        $this->checked = true;
    }
    
    public function uncheck(){
        $this->checked = false;
    }
    
    public function isChecked(){
        return $this->checked;
    }
    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'required' => false,
            'validation' => $this->getValidationArray(),
            'type' => $this->getType(),
            'checked' => $this->isChecked(),
            'title' => $this->getTitle(),
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
