<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of DropDownList
 *
 * @author ishibkikh
 */
class DropDownList extends AbstractInputValue {
    
    private $items = array(), $depend_field, $url;
    
    public function __construct($name, $label, $required = false) {
        $this->setName($name);
        $this->setLabel($label);
        if ($required){
            $this->setRequired();
        }
        $this->setType(\Form\ElementTypes::SELECT);
    }
    
    public function appendItem($value, $label){
        $this->items[] = array($value => $label);
    }
    
    public function importFromDb($table, $valuesField, $labalField){
        $req = new \DB\SQL\RequestBuilder(\DB\SQL\MySqlConnector::getInstance());
        $items = $req->select(array($valuesField, $labalField))->from($table)->fetchAll();
        if (!$items){
            return false;
        }
        foreach ($items as $item){
            $this->appendItem($item[$valuesField], $item[$labalField]);
        }
        return true;
    }
    
    public function getItems(){
        return $this->items;
    }
    
    public function getArray() {
        return array(
            'label' => $this->getLabel(),
            'required' => $this->isRequired(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'validation' => $this->getValidationArray(),
            'items' => $this->getItems(),
            'disabled' => $this->isDisabled()
        );
    }
    
    public function onSelectChange($field, $url){
        $this->depend_field = $field;
        $this->url = $url;
    }
    
    private function renderItems(){
        $html = '';
        foreach ($this->items as $row){
            list($key, $value) = each($row);
            if ($key == $this->getValue()){
                $html .= '<option selected value="'.$key.'">'.$value.'</option>';
            }
            else{
                $html .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }
        return $html;
    }
    
    public function getHtml() {
        
        $at = new \Form\ConstructAttributes();
        $at->append('name', $this->getName());
        if ($this->isDisabled()){
            $at->append('disabled', null);
        }
        $depend = null;
        if ($this->depend_field !== null){
            $depend = ' depend-field="'.$this->depend_field.'"';
            $depend .= ' depend-url="'.$this->url.'"';
        }
        
        return '<select'.$depend.' class="form-control" '.$at->render().'>'.$this->renderItems().'</select>';
    }
}
