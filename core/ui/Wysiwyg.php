<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Textarea
 *
 * @author Ivan
 */
class Wysiwyg extends MultipleRowsText {
    
    public function __construct($name, $label, $required = false) {
        parent::__construct($name, $label, $required);
    }
    
    public function getHtml() {
        $file = PATH.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'wysiwyg.tpl';
        if (!file_exists($file)){
            throw new \System\Exception('WYSIWYG template file not found: '.$file);
        }
        $toolbar = file_get_contents($file);
        if ($this->getValue() === null){
            $this->setValue('<p class="text-left">Замените этот текст</p>');
        }
        
        return $toolbar.'<div id="wysiwyg">'.$this->getValue().'</div><textarea id="html-editor" name="'.$this->getName().'" style="display:none"></textarea>';
    }
}
