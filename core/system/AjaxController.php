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
abstract class AjaxController extends \System\Controller {
    
    protected $answer = array();
    
    public function __construct(CommandContext $request){
        parent::__construct($request);
        $this->setContentTypeJson();
        $this->setComplited();
    }
    
    public function ajax_func($func_name, $value){
        $this->answer['type'] = 'func';
        $this->answer['value'] = $value;
        $this->answer['func'] = $func_name;
        $this->ajax_save_answer();
    }
    
    public function ajax_redirect($url){
        
        $this->answer['type'] = 'redirect';
        $this->answer['value'] = $url;
        $this->ajax_save_answer();
    }
    
    public function ajax_refresh()
    {
        $this->answer['type'] = 'refresh';
        $this->ajax_save_answer();
    }
    
    public function ajax_success($text)
    {
        $this->answer['type'] = 'success';
        $this->answer['value'] = $text;
        $this->ajax_save_answer();
    }
    
    public function ajax_form_error($field, $error){
        $this->answer['type'] = 'fail';
        $this->answer['value'] = array(array('name' => $field, 'error' => $error));
        $this->ajax_save_answer();
    }
    
    public function ajax_fail($text)
    {
        $this->answer['type'] = 'fail';
        $this->answer['value'] = $text;
        $this->ajax_save_answer();
    }
    
    public function ajax_red_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 3;
        $this->ajax_save_answer();
    }
    
    public function ajax_green_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 1;
        $this->ajax_save_answer();
    }
    
    public function ajax_yellow_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 2;
        $this->ajax_save_answer();
    }
    
    public function ajax_lightblue_alert($text){
        $this->answer['type'] = 'alert';
        $this->answer['value'] = $text;
        $this->answer['color'] = 4;
        $this->ajax_save_answer();
    }
    
    public function ajax_popup($title, $text){
        $this->answer['type'] = 'popup';
        $this->answer['value'] = $text;
        $this->answer['title'] = $title;
        $this->ajax_save_answer();
    }
    
    private function ajax_save_answer(){
        $this->context->setBuffer($this->answer);
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
