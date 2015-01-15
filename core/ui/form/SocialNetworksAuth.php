<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace UI\Form;
/**
 * Description of Hr
 *
 * @author ishibkikh
 */
class SocialNetworksAuth extends AbstractInputValue {
    
    private $return;
    
    public function __construct($return_url) {
        $this->setType(\Form\ElementTypes::DESIGN);
        $this->return = $return_url;
        $this->setName('auth');
    }
    
    public function getArray() {
        return array(
            'type' => $this->getType(),
            'html' => '<script src="//ulogin.ru/js/ulogin.js"></script><div class="pull-right" id="uLogin" data-ulogin="display=small;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook,twitter;hidden=;redirect_uri='.$this->return.'"></div>',
            'label'=> null
        );
    }
    
    public function getHtml() {
        return '<hr>';
    }
    
}
