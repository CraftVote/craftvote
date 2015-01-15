<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Navtabs
 *
 * @author ishibkikh
 */
class Navtabs {
    
    protected $items = array(), $body;
    
    
    public function append($label, $src, $active = false){
        $this->items[] = array($label, $src, $active);
    }

    public function body($html){
        $this->body = $html;
    }
    
    public function toHtml() {
        $html = '<ul class="nav nav-tabs">';
        foreach ($this->items as $item){
            if ($item[2] == true){
                $html .= '<li role="presentation" class="active"><a href="#">'.$item[0].'</a></li>';
            }
            else{
                $html .= '<li role="presentation"><a href="'.$item[1].'">'.$item[0].'</a></li>';
            }
        }
        $html .= '</ul><div class="nav-container">'.$this->body.'</div>';
        return $html;
    }
}
