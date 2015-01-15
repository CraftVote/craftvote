<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace UI\Form;
/**
 * Description of Hr
 *
 * @author ishibkikh
 */
class Hr extends AbstractElement {
    
    public function __construct() {
        $this->setType(\Form\ElementTypes::DESIGN);
    }
    
    public function getArray() {
        return array(
            'type' => $this->getType(),
            'html' => '<hr>',
            'label'=> null
        );
    }
    
    public function getHtml() {
        return '<hr>';
    }
    
}
