<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of View
 *
 * @author Ivan
 */
abstract class View {
    
    private $context, $selector;
    
    abstract public function execute();
    
    public function __construct(\System\CommandContext $context){
        $this->context = $context;
    }

    public function getParam($key){
        return $this->context->getCustomParam($key);
    }

    protected function append($param, $value){
        if ($param === NULL){
            $this->write(NULL, $value.PHP_EOL.'<!--BODY-->');
            $this->selector = 'BODY';
        }
        else
        {
            $string = $value.PHP_EOL.'<!--'.strtoupper($param).'-->';
            $this->write($param, $string);
        }
    }
    
    public function body($value){
        $this->append($this->selector, $value);
    }

    protected function write($param, $value){
        if (($this->context->getBuffer() === null)and($param === null)){
            $this->context->setBuffer($value);
            return true;
        }
        if (stripos($this->context->getBuffer(), '<!--'.strtoupper($param).'-->') !== false){
            $this->context->setBuffer(str_replace('<!--'.$param.'-->', $value, $this->context->getBuffer()));
        }
        else {
           throw new Exception('Content variable "'.$param.'" not found in current template');
        }
    }

    public function title($text){
        $this->write('H_TITLE', $text);
    }
    
    protected function loadFromFile($name){
        $name = str_replace(' ', DIRECTORY_SEPARATOR, $name);
        $file = PATH.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.strtolower($name).'.tpl';
        if (!file_exists($file)){
           throw new Exception('Template not found: '.$file);
        }
        return file_get_contents($file);
    }
    
    public function layout($name, $selector = null){
       if ($selector === null){
           $this->selector = 'BODY';
       }
       else {
           $this->selector = $selector;
       }
        
       if ($name === null){
            $this->context->setBuffer('<!--'.$this->selector.'-->');
       }
       else{
            $this->context->setBuffer($this->loadFromFile('layouts '.$name));
            $this->renderWidgets();
       }
    }
    
    public function writeFromFile($selector, $filename){
        
        $this->write($selector, $this->loadFromFile('templates '.$filename));
    }


    public function template($name){
       
       if ($this->context->getBuffer() === null){
           $this->context->setBuffer($this->loadFromFile('templates '.$name));
       }
       else{
           $this->write($this->selector, $this->loadFromFile('templates '.$name));
       }
    }
    
    protected function renderWidgets()
    {
        $p1='/<!--\[([\/a-zA-Z0-9]+)\]-->/';
        $n = preg_match_all($p1, $this->context->getBuffer(), $matches);
        for ($i=0; $i<$n; $i++){
             $p2='<!--['.$matches[1][$i].']-->';
             $widget = new \System\Service('/'.$matches[1][$i]);
             $this->context->setBuffer(str_replace($p2, $widget->getContent(), $this->context->getBuffer()));
             unset($widget);
        }    
    }
    
    public function getContextError(){
        return $this->context->getError();
    }
}
