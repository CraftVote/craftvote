<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form;

/**
 * Description of File
 *
 * @author ishibkikh
 */
class File extends AbstractInputValue {
    
    private $url;
    
    public function __construct($name, $label, $upload_url, $required = false){
        $this->setName($name);
        $this->setLabel($label);
        $this->setUploadUrl($upload_url);
        $this->setType(\Form\ElementTypes::FILE);
        if ($required){
            $this->setRequired();
        }
    }

    public function setUploadUrl($url){
        $this->url = $url;
    }
    
    public function getUploadUrl(){
        return $this->url;
    }

    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'required' => $this->isRequired(),
            'type' => $this->getType(),
            'url' => $this->getUploadUrl(),
            'validation' => $this->getValidationArray(),
            'disabled' => $this->isDisabled()
        );
    }
    
    public function getHtml() {
        return '<span id="file-label"></span> <button id="file-btn" class="btn btn-default btn-sm" type="button">Обзор</button><input id="file-dest" url="'.$this->getUploadUrl().'" name="'.$this->getName().'" type="file" style="visibility:hidden;">';
    }
}
