<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Form;

/**
 * Description of ConstructAttributes
 *
 * @author Ivan
 */
class ConstructAttributes {
    
    private $attrubutes = array();
    
    public function append($name, $value){
        
        if ($value !== null){
            $this->attrubutes[] = $name.'="'.$value.'"';
        }
        else{
            $this->attrubutes[] = $name;
        }
    }
    
    public function importArray($array){
        foreach ($array as $key => $value){
            $this->attrubutes[] = $key.'="'.$value.'"';
        }
    }
    
    public function render(){
        return implode(' ', $this->attrubutes);
    }
}
