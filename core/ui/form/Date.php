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
class Date extends AbstractElement {
    
    public function render() {
        
        return '<div class="input-group date-picker">'
                . '<input type="text" name="'.$this->name.'" class="form-control">'
                . '<span class="input-group-btn">'
                    . '<button class="btn btn-default" type="button">'
                        . '<span class="glyphicon glyphicon-calendar"></span>'
                    . '</button>'
                . '</span>'
            . '</div>';
    }
    
}
