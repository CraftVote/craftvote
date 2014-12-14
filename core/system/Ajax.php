<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of AjaxController
 *
 * @author Ivan
 */
class Ajax {
    
    protected $answer = array();
    
     public function ajax_func($func_name, $value){
        $this->answer['type'] = 'func';
        $this->answer['value'] = $value;
        $this->answer['func'] = $func_name;
    }
    
    public function clearForm($formname){
        $this->answer['clear'] = $formname;
    }

    public function ajax_redirect($url){
        
        $this->answer['type'] = 'redirect';
        $this->answer['value'] = $url;
    }
    
    public function ajax_refresh()
    {
        $this->answer['type'] = 'refresh';
    }
    
    public function ajax_success($text)
    {
        $this->answer['type'] = 'success';
        $this->answer['value'] = $text;
    }
    
    public function ajax_form_error($field, $error){
        $this->answer['type'] = 'fail';
        $this->answer['value'] = array(array('name' => $field, 'error' => $error));
    }
    
    public function ajax_fail($text)
    {
        $this->answer['type'] = 'fail';
        $this->answer['value'] = $text;
    }
    
    public function ajax_red_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 3;
    }
    
    public function ajax_green_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 1;
    }
    
    public function ajax_yellow_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 2;
    }
    
    public function ajax_lightblue_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 4;
    }
    
    public function ajax_popup($title, $text){
        $this->answer['type'] = 'popup';
        $this->answer['value'] = $text;
        $this->answer['title'] = $title;
    }
    
    public function getArray(){
        return $this->answer;
    }
    
    public function ajax_validate_form($form){
        $validator = new \Form\Validator($form);
        if (!$validator->validate()){
            $this->ajax_fail($validator->getErrors());
            return false;
        }
        return $validator->getItems();
    }
    
}
