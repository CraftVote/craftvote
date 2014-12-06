<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of StaticLink
 *
 * @author Ivan
 */
class ConfirmDlg extends AbstractInputValue{
    
    private $dlg_text, $dlg_action;
    
    public function setDlgText($text){
        $this->dlg_text = $text;
    }
    
    public function getDlgText(){
        return $this->dlg_text;
    }
    
    public function setLink($action){
        $this->dlg_action = $action;
    }
    
    public function getLink(){
        return $this->dlg_action;
    }
    
    public function __construct($label, $title, $dlgText, $link) {
        $this->setLabel($label);
        $this->setValue($title);
        $this->setDlgText($dlgText);
        $this->setLink($link);
        $this->setType(\Form\ElementTypes::CONFIRM_DLG_LINK);
    }
    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'validation' => $this->getValidationArray(),
            'link' => $this->getLink(),
            'message' => $this->getDlgText()
        );
    }
    
    public function getHtml() {
        return '<p class="form-control-static"><a href="#" onclick="Modal.confirm(\''.$this->getDlgText().'\',\''.$this->getLink().'\',\'\');">'.$this->getValue().'</a></p>';
    }
}
