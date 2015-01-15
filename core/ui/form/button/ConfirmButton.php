<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI\Form\Button;

/**
 * Description of ConfirmButton
 *
 * @author ishibkikh
 */
class ConfirmButton extends AbstractButton {
    
    private $message, $link;
    
    public function setMessage($message){
        $this->message = $message;
    }
    
    public function getMessage(){
        return $this->message;
    }
    
    public function setLink($link){
        $this->link = $link;
    }
    
    public function getLink(){
        return $this->link;
    }
    
    public function __construct($title, $message, $link) {
        parent::__construct();
        $this->setType(\Form\ElementTypes::CONFIRM_BUTTON);
        $this->setTitle($title);
        $this->setLink($link);
        $this->setMessage($message);
    }
    
    public function getArray() {
        return array(
            'title' => $this->getTitle(),
            'submit' => false,
            'class' => $this->renderClass(),
            'message' => $this->getMessage(),
            'action' => $this->getLink()
        );
    }
    
    public function getHtml() {
        $at = new \Form\ConstructAttributes();
        
        if ($this->getLink() !== null){
            $at->append('onclick', 'Modal.confirm(\''.$this->getMessage().'\', \''.$this->getLink().'\', \'\'); return false;');
        }
        $at->append('class', $this->renderClass());
        return '<button '.$at->render().'>'.$this->getTitle().'</button>';
    }
}
