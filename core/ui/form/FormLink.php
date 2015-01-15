<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form;

/**
 * Description of FormLink
 *
 * @author ishibkikh
 */
class FormLink extends AbstractInputValue{
    
    private $link;
    
    public function setLink($link){
        $this->link = $link;
    }
    
    public function getLink(){
        return $this->link;
    }
    
    public function __construct($label, $title, $link){
        $this->setLabel($label);
        $this->setType(\Form\ElementTypes::MODAL_FORM_LINK);
        $this->setValue($title);
        $this->setLink($link);
    }
    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'validation' => $this->getValidationArray(),
            'link' => $this->getLink()
        );
    }
    
    public function getHtml() {
        return '<p class="form-control-static"><a href="#" onclick="Modal.loadForm(\''.$this->getLink().'\');">'.$this->getValue().'</a></p>';
    }
}
