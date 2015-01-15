<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form;

/**
 * Description of TextValue
 *
 * @author Ivan
 */
abstract class AbstractTextValue extends AbstractInputValue {
    
    private $minLen, $maxLen, $placeholder;
    
    public function setMinLen($int){
        $this->minLen = $int;
        return $this;
    }
    
    public function getMinLen(){
        return $this->minLen;
    }
    
    public function setMaxLen($int){
        $this->maxLen = $int;
        return $this;
    }
    
    public function getMaxLen(){
        return $this->maxLen;
    }
    
    public function setPlaceholder($text){
        $this->placeholder = $text;
        return $this;
    }
    
    public function getPlaceholder(){
        return $this->placeholder;
    }
}
