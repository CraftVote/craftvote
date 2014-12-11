<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\MySQL;

/**
 * Description of Builder
 *
 * @author ishibkikh
 */
class Builder {
    
    static public function condition($entity){
        $items = array();
        foreach ($entity as $key => $value){
            if (($key === $entity->getPrimaryKey())or($value === NULL)){
                continue;
            }
            if (is_string($value)){
                $items[] = $key.'=\''.$value.'\'';
            }
            else{
                $items[] = $key.'='.$value;
            }
        }
        return implode(' AND ', $items);
    }
    
    static public function fields($entity){
        return ' ';
    }
    
    static public function items($entity){
        $items = array();
        foreach ($entity as $key => $value){
            if (($key === $entity->getPrimaryKey())or($value === NULL)){
                continue;
            }
            if (is_string($value)){
                $items[] = $key.'=\''.$value.'\'';
            }
            else{
                $items[] = $key.'='.$value;
            }
        }
        return implode(', ', $items);
    }
    
    static public function values($entity){
        return ' ';
    }
}
