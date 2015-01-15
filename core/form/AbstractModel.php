<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Form;

/**
 * Description of Model
 *
 * @author ishibkikh
 */
abstract class AbstractModel {
    
    protected $attributes = array(), $title, $elements = array(), $label_len = 2, $field_len = 8, $buttons = array();
    
    abstract protected function renderForm();
    
    public function __construct($name, $action) {
        $this->setName($name);
        $this->setAction($action);
        $this->attributes['class'] = 'form-horizontal';
        $this->attributes['role'] = 'form';
    }

    private function importArrayElements($elements){
        $output = array();
        foreach ($elements as $element){
            if ($element->getType()!== ElementTypes::DESIGN){
                $output[$element->getName()] = $element->getArray();
            }
            else{
                $output[] = $element->getArray();
            }
        }
        return $output;
    }
    
    private function importArrayButton($buttons){
        $output = array();
        foreach ($buttons as $element){
            if ($element->isSubmit()){
                $element->setForm($this->attributes['name']);
            }
            $output[] = $element->getArray();
        }
        return $output;
    }
    
    public function getArray(){
        $this->renderForm();
        return array(
            'title' => $this->title,
            'attributes' => $this->attributes,
            'elements' => $this->importArrayElements($this->elements),
            'buttons' => $this->importArrayButton($this->buttons),
            'label_len' => $this->label_len,
            'field_len' => $this->field_len
        );
    }
    
    public function __toString() {
        return $this->getHtml();
    }

    public function getHtml(){
        $this->renderForm();
        $at = new ConstructAttributes();
        $at->importArray($this->attributes);
        $html = '<div id="alert-area"></div><form '.$at->render().'>';
        foreach ($this->elements as $element){
            if ($element->getType() !== ElementTypes::DESIGN){
                $html .= '<div class="form-group has-feedback"><label class="col-sm-'.$this->label_len.' control-label">'.$element->getLabel().'</label><div class="col-sm-'.$this->field_len.'">';
                $html .= $element->getHtml();
                $html .= '</div></div>';
            }
            else{
                $html .= $element->getHtml();
            }
        }
        $html .= '<div class="form-group has-feedback"><label class="col-sm-'.$this->label_len.' control-label"></label><div class="col-sm-'.$this->field_len.'">';
        foreach ($this->buttons as $element){
            if ($element->isSubmit()){
                $element->setForm($this->attributes['name']);
            }
            $html .= $element->getHtml().' ';
        }
        $html .= '</div></div>';
        $html .= '<input type="hidden" name="__rules" value="'.base64_encode(json_encode($this->importArrayElements($this->elements))).'">';
        $html .= '</form>';
        return $html;
    }
    
    public function setName($name){
        $this->attributes['name'] = $name;
        return $this;
    }
    
    public function setAction($url){
        $this->attributes['action'] = $url;
        return $this;
    }
    
    public function autocompleteOn(){
        $this->attributes['autocomplete'] = 'on';
        return $this;
    }
    
    public function appendHr(){
        $this->elements[] = new \UI\Form\Hr();
    }
    
    public function autocompleteOff(){
        $this->attributes['autocomplete'] = 'off';
        return $this;
    }
    
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    
    public function appendElement($element){
        $this->elements[] = $element;
        return $this;
    }
    
    public function appendButton($button){
        $this->buttons[] = $button;
        return $this;
    }
    
    public function enctype($enctype){
        $this->attributes['enctype'] = $enctype;
        return $this;
    }
    
    public function encoding($encoding){
        $this->attributes['encoding'] = $encoding;
        return $this;
    }
    
    public function setId($id){
        $this->attributes['id'] = $id;
        return $this;
    }
    
    public function setLabelLen($int){
        $this->label_len = $int;
        return $this;
    }
    
    public function setFieldLen($int){
        $this->field_len = $int;
        return $this;
    }
}
