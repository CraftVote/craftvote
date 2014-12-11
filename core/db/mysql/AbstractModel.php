<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\MySQL;

/**
 * Description of Model
 *
 * @author Ivan
 */
abstract class AbstractModel {
    
    abstract public function getPrimaryKey();
    
    public function getId(){
        return $this->{$this->getPrimaryKey()};
    }
    
    public function setId($id){
        $this->{$this->getPrimaryKey()} = $id;
    }
    
    public function assignFromArray($array){
        if (!is_array($array)){
            throw new \System\Exception('Can not assign values from not array');
        }
        foreach ($array as $key => $value){
            if (property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }
    
    public function clear(){
        foreach ($this as $key => $value){
            if ($key === $this->getPrimaryKey()){
                continue;
            }
            else{
                $this->{$key} = NULL;
            }
        }
    }
}
