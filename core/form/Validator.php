<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComFormError
 *
 * @author ishibkikh
 */
namespace Form;

class Validator {
    
    private $elements = array(), $output = array(), $error_stack = array();
    
    public function get($name)
    {
        return $this->output[$name];
    }
    
    public function set($name, $value)
    {
        $this->output[$name] = $value;
    }
    
    public function getItems(){
        return $this->output;
    }
    
    public function isExist($name){
        return isset($this->output[$name]);
    }

    public function isErrors()
    {
        return count($this->error_stack)>0;
    }

    public function __construct($form)
    {
        if (!is_subclass_of($form, '\Form\AbstractModel')){
            throw new \System\Exception('Class "'.get_class($form).'" should be child of \Form\AbstractModel');
        }
        $this->elements = $form->getArray()['elements'];
    }
    
    public function appendError($key, $text){
        $this->error_stack[] = array('name' => $key, 'error' => $text);
    }
    
    private function getInputValue($name){
        return filter_input(INPUT_POST, $name, FILTER_SANITIZE_STRING);
    }
    
    private function getBool($name){
        return filter_input(INPUT_POST, $name, FILTER_VALIDATE_BOOLEAN);
    }

    public function validate()
    {
        foreach ($this->elements as $name => $attr)
        {
            if ($attr['type'] === ElementTypes::DESIGN){
                continue;
            }
            if ($attr['type'] === ElementTypes::CHECKBOX){
                $this->set($name, $this->getBool($name));
                continue;
            }
            $value = $this->getInputValue($name);
            if ($this->verifyFirst($name, $value, $attr)){
                $this->set($name, $value);
            }
        }
        return (!$this->isErrors());
    }
    
    public function getErrors(){
        return $this->error_stack;
    }
    
    public function verifyFirst($name, $value, $attr){
        
        if (($attr['required'] === true)and(($value === '')or($value === null))){
            $this->appendError($name, ErrorText::no_empty());
            return false;
        }
        if (($attr['minlen'] !== null)and($attr['minlen'] > 0)and(strlen($value) > 0)and(mb_strlen($value, 'UTF-8') < $attr['minlen'])){
            $this->appendError($name, ErrorText::min_len($attr['minlen']));
            return false;
        }
        if (($attr['maxlen'] !== null)and($attr['maxlen'] > 0)and(strlen($value) > 0)and(mb_strlen($value, 'UTF-8') > $attr['maxlen'])){
            $this->appendError($name, ErrorText::max_len($attr['maxlen']));
            return false;
        }
        if ($attr['type'] === ElementTypes::CAPTCHA){
            if(!\Form\VerifyField::captcha($value)){
                $this->appendError($name, ErrorText::captcha());
                return false;
            }
        }
        if (mb_strlen($value) > 0){
            if (!$this->verifySecond($name, $value, $attr)){
                return false;
            }
        }
        return true;
    }
    
    
    protected function verifySecond($name, $value, $attr){
        
        foreach ($attr['validation'] as $valid){
  
            if ($valid['type'] === ElementValidations::EMAIL){
                if(!\Form\VerifyField::email($value)){
                    $this->appendError($name, ErrorText::email());
                    return false;
                }
            }
            if ($valid['type'] === ElementValidations::EQUALFIELD){
                if(!\Form\VerifyField::equalfield($value, $this->get($valid['param']))){
                    $this->appendError($name, ErrorText::equalfield());
                    return false;
                }
            }
            if ($valid['type'] === ElementValidations::DB_UNIQUE_FIELD){
                $db_table = $valid['param'][0];
                $db_field = $valid['param'][1];
                if(!\Form\VerifyField::unique_db_field($value, $db_table, $db_field)){
                    $this->appendError($name, ErrorText::unique_db_field());
                    return false;
                }
            }
            if ($valid['type'] === ElementValidations::DATE){
                if(!\Form\VerifyField::date($value)){
                    $this->appendError($name, ErrorText::date());
                    return false;
                }
            }
            if ($valid['type'] === ElementValidations::NUMBER){
                if(!\Form\VerifyField::numint($value)){
                    $this->appendError($name, ErrorText::numint());
                    return false;
                }
            }
        }
        return true;
    }
}
