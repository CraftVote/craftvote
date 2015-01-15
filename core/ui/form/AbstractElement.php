<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace UI\Form;
/**
 * Description of AbstractElement
 *
 * @author Ivan
 */
abstract class AbstractElement {
    
    private $type;
    
    abstract public function getArray();
    abstract public function getHtml();
    
    public function setType($type){
        $this->type = $type;
        return $this;
    }
    
    public function getType(){
        return $this->type;
    }
}
