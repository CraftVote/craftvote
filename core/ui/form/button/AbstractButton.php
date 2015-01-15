<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form\Button;

/**
 * Description of Button
 *
 * @author Ivan
 */
abstract class AbstractButton extends \UI\Form\AbstractElement{
    
    private $color = 'btn-default', $title, $submit=false, $form, $width, $alignment, $link;
    
    public function __construct() {
        $this->setType(\Form\ElementTypes::BUTTON);
    }

    public function setRedColor(){
        $this->color = 'btn-danger';
        return $this;
    }
    
    public function setLink($link){
        $this->link = $link;
    }
    
    public function setWidthSm(){
        $this->width = 'btn-width-sm';
        return $this;
    }
    
    public function getWidth(){
        return $this->width;
    }

    public function setGreenColor(){
        $this->color = 'btn-success';
        return $this;
    }
    
    public function setBlueColor(){
        $this->color = 'btn-primary';
        return $this;
    }
    
    public function setLightBlueColor(){
        $this->color = 'btn-info';
        return $this;
    }
    
    public function setYellowColor(){
        $this->color = 'btn-warning';
        return $this;
    }
    
    public function getColor(){
        return $this->color;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function setForm($form){
        $this->form = $form;
    }
    
    public function getForm(){
        return $this->form;
    }
    
    public function submit(){
        $this->submit = true;
    }
    
    public function isSubmit(){
        return $this->submit;
    }
    
    public function setRightAlignment()
    {
        $this->alignment = 'pull-right';
        return $this;
    }
    
    public function getAlignment(){
        return $this->alignment;
    }
    
    public function getArray() {
        return array(
            'title' => $this->getTitle(),
            'submit' => $this->isSubmit(),
            'form' => $this->getForm(),
            'class' => $this->renderClass()
        );
    }
    
    protected function renderClass(){
        $class = 'btn';
        if ($this->getColor() !== null){
            $class .= ' '.$this->getColor();
        }
        if ($this->getAlignment() !== null){
            $class .= ' '.$this->getAlignment();
        }
        if ($this->getWidth() !== null){
            $class .= ' '.$this->getWidth();
        }
        return $class;
    }
    
    public function getHtml() {
        $at = new \Form\ConstructAttributes();
        if ($this->getForm() !== null){
            $at->append('state-loading', 'stopped');
            $at->append('submit', $this->getForm());
        }
        else{
            if ($this->link !== null){
                $at->append('onclick', 'window.location.href = \'' . $this->link . '\'; return false;');
            }
        }
        
        $at->append('class', $this->renderClass());
        
        return '<button '.$at->render().'>'.$this->getTitle().'</button>';
    }
}
