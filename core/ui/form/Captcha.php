<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form;

/**
 * Description of Captcha
 *
 * @author ishibkikh
 */
class Captcha extends AbstractTextValue {
    
    public function __construct($name, $label) {
        $this->setName($name);
        $this->setLabel($label);
        $this->setRequired();
        $this->setMaxLen(8);
        $this->setType(\Form\ElementTypes::CAPTCHA);
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
            'disabled' => $this->isDisabled()
        );
    }
    
    public function getHtml() {
        $at = new \Form\ConstructAttributes();
        $at->append('name', $this->getName());
        if ($this->getPlaceholder() !== null){
            $at->append('placeholder', $this->getPlaceholder());
        }
        if($this->isDisabled()){
            $at->append('disabled', null);
        }
        $at->append('maxlength', $this->getMaxLen());
        
        return '<div class="row"><div class="col-xs-6"><img id="captcha-img" src="/_system/captcha"></div><div class="col-xs-6"><input class="form-control" type="text" '.$at->render().'></div></div>';
    }
}
